<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/6
 * Time: 上午 11:57
 */

namespace Modules\Storytelling\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Storytelling\RegionSettingNodeCodeConstants;

class RegionSettingPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return RegionSettingNodeCodeConstants::STORYTELLING_REGION_SETTING_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return RegionSettingNodeCodeConstants::STORYTELLING_REGION_SETTING_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return RegionSettingNodeCodeConstants::STORYTELLING_REGION_SETTING_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return RegionSettingNodeCodeConstants::STORYTELLING_REGION_SETTING_DELETE;
    }
}
