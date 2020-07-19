<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 上午 11:39
 */

namespace Modules\Photograph\Policies;

use Modules\Base\Policies\CRUDPolicy;
use Modules\Node\Constants\Photograph\PhotographyManageNodeCodeConstants;

class PhotographyManagePolicy extends CRUDPolicy
{
    /**
     * @return string
     */
    protected function readNode(): string
    {
        return PhotographyManageNodeCodeConstants::PHOTOGRAPH_MANAGE_READ;
    }

    /**
     * @return string
     */
    protected function createNode(): string
    {
        return PhotographyManageNodeCodeConstants::PHOTOGRAPH_MANAGE_CREATE;
    }

    /**
     * @return string
     */
    protected function updateNode(): string
    {
        return PhotographyManageNodeCodeConstants::PHOTOGRAPH_MANAGE_UPDATE;
    }

    /**
     * @return string
     */
    protected function deleteNode(): string
    {
        return PhotographyManageNodeCodeConstants::PHOTOGRAPH_MANAGE_DELETE;
    }
}
