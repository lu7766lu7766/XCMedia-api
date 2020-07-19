<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 04:14
 */

namespace Modules\Video\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Video\AdultVideoNodeCodeConstants;

class AdultVideoPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return AdultVideoNodeCodeConstants::VIDEO_ADULT_VIDEO_MANAGE_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return AdultVideoNodeCodeConstants::VIDEO_ADULT_VIDEO_MANAGE_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return AdultVideoNodeCodeConstants::VIDEO_ADULT_VIDEO_MANAGE_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return AdultVideoNodeCodeConstants::VIDEO_ADULT_VIDEO_MANAGE_DELETE;
    }
}
