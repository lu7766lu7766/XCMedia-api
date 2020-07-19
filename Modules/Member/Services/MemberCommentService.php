<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/10
 * Time: 下午 04:46
 */

namespace Modules\Member\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\ApiCode\OOOO4MemberCode;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Classified\Contracts\IClassifiedRepo;
use Modules\Member\Contracts\ICommentEntity;
use Modules\Member\Http\Requests\Client\Comment\MemberCommentAddRequestHandle;
use Modules\Member\Repositories\MemberCommentRepo;
use Modules\Member\Repositories\MemberRepo;

class MemberCommentService
{
    /** @var \Modules\Member\Entities\Member|null $member */
    private $member;
    /** @var IClassifiedRepo $classifiedRepo */
    private $classifiedRepo;
    /** @var MemberCommentRepo $repo */
    private $repo;

    /**
     * MemberCommentService constructor.
     * @param Authenticatable $auth
     * @param IClassifiedRepo $classifiedRepo
     * @throws ApiErrorCodeException
     */
    public function __construct(Authenticatable $auth, IClassifiedRepo $classifiedRepo)
    {
        $this->member = app(MemberRepo::class)->find($auth->getAuthIdentifier());
        if (is_null($this->member)) {
            throw new ApiErrorCodeException(OOOO4MemberCode::MEMBER_NOT_FOUND, 'member not found');
        }
        $this->classifiedRepo = $classifiedRepo;
        $this->repo = new MemberCommentRepo();
    }

    /**
     * @param MemberCommentAddRequestHandle $request
     * @return bool
     * @throws ApiErrorCodeException
     */
    public function add(MemberCommentAddRequestHandle $request)
    {
        /** @var ICommentEntity $media */
        $media = $this->classifiedRepo->findEnable($request->getMediaId());
        if (is_null($media)) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::MODEL_NOT_FOUND, 'model not found');
        }

        return $this->repo->add($media, $this->member->getKey(), $request->getContents());
    }
}
