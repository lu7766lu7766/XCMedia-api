<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/5
 * Time: 下午 07:41
 */

namespace Modules\Literature\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Literature\RegionSettingNodeCodeConstants;

class RegionSettingPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return RegionSettingNodeCodeConstants::LITERATURE_REGION_SETTING_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return RegionSettingNodeCodeConstants::LITERATURE_REGION_SETTING_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return RegionSettingNodeCodeConstants::LITERATURE_REGION_SETTING_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return RegionSettingNodeCodeConstants::LITERATURE_REGION_SETTING_DELETE;
    }
}
