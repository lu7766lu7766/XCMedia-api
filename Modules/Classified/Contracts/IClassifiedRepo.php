<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/10
 * Time: 下午 04:54
 */

namespace Modules\Classified\Contracts;

interface IClassifiedRepo
{
    /**
     * @param int $id
     * @return IClassifiedEntity|null
     */
    public function findEnable(int $id): ?IClassifiedEntity;
}
