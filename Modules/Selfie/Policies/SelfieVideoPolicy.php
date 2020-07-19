<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/2
 * Time: 下午 04:28
 */

namespace Modules\Selfie\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Selfie\SelfieVideoNodeCodeConstants;

class SelfieVideoPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return SelfieVideoNodeCodeConstants::SELFIE_VIDEO_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return SelfieVideoNodeCodeConstants::SELFIE_VIDEO_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return SelfieVideoNodeCodeConstants::SELFIE_VIDEO_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return SelfieVideoNodeCodeConstants::SELFIE_VIDEO_DELETE;
    }
}
