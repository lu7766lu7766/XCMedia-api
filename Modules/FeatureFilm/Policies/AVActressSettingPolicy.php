<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 02:17
 */

namespace Modules\FeatureFilm\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\FeatureFilm\AVActressSettingNodeCodeConstants;

class AVActressSettingPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return AVActressSettingNodeCodeConstants::FEATURE_FILM_AV_ACTRESS_SETTING_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return AVActressSettingNodeCodeConstants::FEATURE_FILM_AV_ACTRESS_SETTING_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return AVActressSettingNodeCodeConstants::FEATURE_FILM_AV_ACTRESS_SETTING_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return AVActressSettingNodeCodeConstants::FEATURE_FILM_AV_ACTRESS_SETTING_DELETE;
    }
}
