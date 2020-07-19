<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/2
 * Time: 下午 04:05
 */

namespace Modules\Selfie\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Selfie\SelfieScheduleNodeCodeConstants;

class SelfieSchedulePolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return SelfieScheduleNodeCodeConstants::SELFIE_SCHEDULE_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return SelfieScheduleNodeCodeConstants::SELFIE_SCHEDULE_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return SelfieScheduleNodeCodeConstants::SELFIE_SCHEDULE_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return SelfieScheduleNodeCodeConstants::SELFIE_SCHEDULE_DELETE;
    }
}
