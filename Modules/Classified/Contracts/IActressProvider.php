<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/27
 * Time: 下午 12:53
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IActressProvider
{
    /**
     * @param array $ids
     * @param string $usedType
     * @return Model[]|Collection
     */
    public function findEnableByUsedType(array $ids, string $usedType);

    /**
     * @param string $usedType
     * @return Model[]|Collection
     */
    public function getEnableByUsedType(string $usedType);
}
