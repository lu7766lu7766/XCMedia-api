<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 03:53
 */

namespace Modules\Selfie\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Selfie\AVActressSettingNodeCodeConstants;

class AVActressSettingPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return AVActressSettingNodeCodeConstants::SELFIE_AV_ACTRESS_SETTING_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return AVActressSettingNodeCodeConstants::SELFIE_AV_ACTRESS_SETTING_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return AVActressSettingNodeCodeConstants::SELFIE_AV_ACTRESS_SETTING_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return AVActressSettingNodeCodeConstants::SELFIE_AV_ACTRESS_SETTING_DELETE;
    }
}
