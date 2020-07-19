<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 下午 02:22
 */

namespace Modules\Selfie\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Selfie\CupSettingNodeCodeConstants;

class CupSettingPolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return CupSettingNodeCodeConstants::SELFIE_CUP_SETTING_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return CupSettingNodeCodeConstants::SELFIE_CUP_SETTING_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return CupSettingNodeCodeConstants::SELFIE_CUP_SETTING_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return CupSettingNodeCodeConstants::SELFIE_CUP_SETTING_DELETE;
    }
}
