<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/3
 * Time: 下午 03:23
 */

namespace Modules\Variety\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Variety\RegionSettingNodeCodeConstants;

class RegionSettingPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return RegionSettingNodeCodeConstants::VARIETY_REGION_SETTING_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return RegionSettingNodeCodeConstants::VARIETY_REGION_SETTING_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return RegionSettingNodeCodeConstants::VARIETY_REGION_SETTING_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return RegionSettingNodeCodeConstants::VARIETY_REGION_SETTING_DELETE;
    }
}
