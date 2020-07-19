<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/13
 * Time: 上午 10:59
 */

namespace Modules\Storytelling\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Storytelling\Entities\StorytellingAudio;
use Modules\Storytelling\Http\Requests\Manage\StorytellingAudio\GetIdRequestHandle;
use Modules\Storytelling\Http\Requests\Manage\StorytellingAudio\StoreRequestHandle;
use Modules\Storytelling\Http\Requests\Manage\StorytellingAudio\ListRequestHandle;
use Modules\Storytelling\Repositories\StorytellingAudioRepo;
use Modules\Storytelling\Repositories\StorytellingRepo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ManageStorytellingAudioService
{
    /** @var StorytellingAudioRepo $repo */
    private $repo;

    /**
     * ManageStorytellingAudioService constructor.
     * @param StorytellingAudioRepo $repo
     */
    public function __construct(StorytellingAudioRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|StorytellingAudio[]
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
            $request->getStorytellingId(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return $this->repo->count($request->getStorytellingId());
    }

    /**
     * @param StoreRequestHandle $request
     * @param Cloud $cloud
     * @param StorytellingRepo $repo
     * @return \Illuminate\Database\Eloquent\Model|null|StorytellingAudio
     * @throws ApiErrorCodeException
     */
    public function create(StoreRequestHandle $request, Cloud $cloud, StorytellingRepo $repo)
    {
        $result = null;
        $storytelling = $repo->find($request->getStorytellingId());
        if (is_null($storytelling)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        $audio = $request->getAudio();
        $uploadPath = $this->upload(config('Storytelling.config.audio_path'), $audio, $cloud);
        $attribute = [
            'original_file_name' => $audio->getClientOriginalName(),
            'file_path'          => $uploadPath,
            'file_url'           => $cloud->url($uploadPath),
        ];
        $result = $storytelling->audio()->create($attribute);
        if (is_null($result)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL, 'CREATE STORYTELLING AUDIO FAIL');
        }

        return $result;
    }

    /**
     * @param GetIdRequestHandle $request
     * @param Cloud $cloud
     * @return StorytellingAudio|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(GetIdRequestHandle $request, Cloud $cloud)
    {
        $storytelling = app(StorytellingRepo::class)->find($request->getStorytellingId());
        /** @var StorytellingAudio $audio */
        $audio = $storytelling->audio()->find($request->getAudioId());
        if (is_null($audio)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }
        if ($this->repo->delete($audio)) {
            $cloud->delete($audio->file_path);
        }

        return $audio;
    }

    /**
     * @param string $path
     * @param UploadedFile $file
     * @param Cloud $cloud
     * @return string
     * @throws ApiErrorCodeException
     */
    private function upload(string $path, UploadedFile $file, Cloud $cloud)
    {
        /** @var string|false $path */
        $path = $cloud->put($path, $file, $cloud::VISIBILITY_PUBLIC);
        if (is_bool($path)) {
            throw  new ApiErrorCodeException(OOOO1CommonCodes::ERROR, 'UPLOAD FILE FAIL');
        }

        return $path;
    }
}
