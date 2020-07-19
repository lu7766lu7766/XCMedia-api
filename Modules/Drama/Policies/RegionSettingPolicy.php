<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/1/30
 * Time: 下午 05:14
 */

namespace Modules\Drama\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Drama\RegionSettingNodeCodeConstants;

class RegionSettingPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return RegionSettingNodeCodeConstants::DRAMA_REGION_SETTING_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return RegionSettingNodeCodeConstants::DRAMA_REGION_SETTING_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return RegionSettingNodeCodeConstants::DRAMA_REGION_SETTING_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return RegionSettingNodeCodeConstants::DRAMA_REGION_SETTING_DELETE;
    }
}
