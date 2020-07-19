<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 01:15
 */

namespace Modules\Photograph\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Photograph\PhotographyPhotoNodeCodeConstants;
use Modules\Node\Contract\IGate;

class PhotographPhotoPolicy
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
        return $this->gate->hasAccess(PhotographyPhotoNodeCodeConstants::PHOTOGRAPH_PHOTO_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(PhotographyPhotoNodeCodeConstants::PHOTOGRAPH_PHOTO_CREATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(PhotographyPhotoNodeCodeConstants::PHOTOGRAPH_PHOTO_DELETE);
    }
}
