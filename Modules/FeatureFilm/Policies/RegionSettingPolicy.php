<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/4
 * Time: 下午 02:42
 */

namespace Modules\FeatureFilm\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\FeatureFilm\RegionSettingNodeCodeConstants;

class RegionSettingPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return RegionSettingNodeCodeConstants::FEATURE_FILM_REGION_SETTING_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return RegionSettingNodeCodeConstants::FEATURE_FILM_REGION_SETTING_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return RegionSettingNodeCodeConstants::FEATURE_FILM_REGION_SETTING_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return RegionSettingNodeCodeConstants::FEATURE_FILM_REGION_SETTING_DELETE;
    }
}
