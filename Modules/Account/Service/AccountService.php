<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/4
 * Time: 下午 12:59
 */

namespace Modules\Account\Service;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Modules\Account\Entities\Account;
use Modules\Account\Entities\AccountCover;
use Modules\Account\Http\Requests\PilotProfileEditRequest;
use Modules\Account\Repository\AccountNodeRepo;
use Modules\Account\Repository\AccountRepo;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\ApiCode\OOOO2AccountCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Node\Entities\Node;

/**
 * Class ProfileService 個人檔案
 * @package Modules\Account\Service
 */
class AccountService
{
    /**
     * @var Authenticatable
     */
    protected $user;
    /**
     * @var AccountRepo
     */
    private $repo;
    /**
     * @var AccountNodeRepo
     */
    private $accountNodeRepo;
    /** @var Filesystem */
    private $storage;

    /**
     * AccountService constructor.
     * @param Authenticatable|null $user
     * @param Filesystem|null $storage
     * @throws ApiErrorCodeException
     */
    public function __construct(Authenticatable $user = null, Filesystem $storage = null)
    {
        if (is_null($user)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::AUTHENTICATION_FAIL, 'you must be a approved user');
        }
        $this->user = $user;
        $this->repo = \App::make(AccountRepo::class);
        $this->accountNodeRepo = \App::make(AccountNodeRepo::class);
        $this->storage = $storage ?? \Storage::disk();
    }

    /**
     * 個人資料
     * @return Account|null
     */
    public function profile()
    {
        $account = $this->repo->find($this->user->getAuthIdentifier());
        $account->load(['cover', 'roles']);
        if (!is_null($cover = $account->cover)) {
            $cover->path = $this->storage->url($account->cover->path);
        }

        return $account;
    }

    /**
     * @param \Modules\Account\Http\Requests\PilotProfileEditRequest $request
     * @return null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function edit(PilotProfileEditRequest $request)
    {
        $attribute = $request->getDisplayName() ? [
            'display_name' => $request->getDisplayName()
        ] : [];
        $exists = $this->repo->find($this->user->getAuthIdentifier());
        if (is_null($exists)) {
            throw new ApiErrorCodeException(OOOO2AccountCodes::ACCOUNT_NOT_FOUND);
        }
        if (!is_null($request->getNewPassword())) {
            if (!\Hash::check($request->getOldPassword(), $exists->getAttribute('password'))) {
                throw new ApiErrorCodeException(OOOO2AccountCodes::ACCOUNT_PASSWORD_AUTH_FAILED);
            }
        }
        \DB::transaction(function () use ($attribute, $exists, $request) {
            $this->repo->update($exists, $attribute, $request->getNewPassword());
            if (!is_null($cover = $request->getCover())) {
                $path = $this->uploadCover($cover);
                if ($path !== false) {
                    $cover = $exists->cover ?: new AccountCover();
                    // delete old cover
                    if ($cover->path) {
                        $this->storage->delete($cover->path);
                    }
                    // attach new cover
                    $exists->setRelation('cover', $exists->cover()->save($cover->fill(compact('path'))));
                }
            }
        });

        return $exists;
    }

    /**
     * @return Node[]|Collection
     */
    public function nodeMap()
    {
        $nodes = $this->accountNodeRepo->enableNodes($this->user->getAuthIdentifier());

        return $nodes;
    }

    /**
     * @param UploadedFile $cover
     * @return \Intervention\Image\Image
     */
    private function resizeImage(UploadedFile $cover)
    {
        $image = ImageManagerStatic::make($cover->getRealPath());
        $resize = min($image->width(), $image->height(), config('Account.config.cover_max_size'));

        return $image->resize($resize, $resize)->encode('png');
    }

    /**
     * @param UploadedFile $cover
     * @return string|false
     */
    private function uploadCover(UploadedFile $cover)
    {
        $image = $this->resizeImage($cover);
        $path = trim(config('Account.config.cover_upload_base_path'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $path = $path . Str::random(40) . '.' . $image->getDriver()->encoder->format;

        return $this->storage->put($path, $image->getEncoded(), 'public') ? $path : false;
    }
}
