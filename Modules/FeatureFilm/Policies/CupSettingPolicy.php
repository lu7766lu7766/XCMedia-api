<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 下午 12:02
 */

namespace Modules\FeatureFilm\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\FeatureFilm\CupSettingNodeCodeConstants;

class CupSettingPolicy extends CRUDPolicy
{

    /**
     * @return string
     */
    protected function readNode(): string
    {
        return CupSettingNodeCodeConstants::FEATURE_FILM_CUP_SETTING_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return CupSettingNodeCodeConstants::FEATURE_FILM_CUP_SETTING_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return CupSettingNodeCodeConstants::FEATURE_FILM_CUP_SETTING_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return CupSettingNodeCodeConstants::FEATURE_FILM_CUP_SETTING_DELETE;
    }
}
