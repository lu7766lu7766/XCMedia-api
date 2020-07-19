<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 06:50
 */

namespace Modules\Video\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Video\AdultVideoBucketNodeCodeConstants;
use Modules\Node\Contract\IGate;

class AdultVideoBucketPolicy
{
    use HandlesAuthorization;
    /**
     * @var IGate
     */
    private $gate;

    /**
     * Create a new policy instance.
     *
     * @param IGate $gate
     */
    public function __construct(IGate $gate)
    {
        $this->gate = $gate;
    }

    /**
     * @return bool
     */
    public function read()
    {
        return $this->gate->hasAccess(AdultVideoBucketNodeCodeConstants::VIDEO_ADULT_VIDEO_BUCKET_MANAGE_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(AdultVideoBucketNodeCodeConstants::VIDEO_ADULT_VIDEO_BUCKET_MANAGE_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(AdultVideoBucketNodeCodeConstants::VIDEO_ADULT_VIDEO_BUCKET_MANAGE_UPDATE);
    }
}
