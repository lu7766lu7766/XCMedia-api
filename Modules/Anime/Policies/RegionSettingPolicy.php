<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/3
 * Time: 下午 04:54
 */

namespace Modules\Anime\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Anime\RegionSettingNodeCodeConstants;

class RegionSettingPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return RegionSettingNodeCodeConstants::ANIME_REGION_SETTING_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return RegionSettingNodeCodeConstants::ANIME_REGION_SETTING_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return RegionSettingNodeCodeConstants::ANIME_REGION_SETTING_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return RegionSettingNodeCodeConstants::ANIME_REGION_SETTING_DELETE;
    }
}
