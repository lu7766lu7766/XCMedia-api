<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/27
 * Time: 下午 01:01
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ICupProvider
{
    /**
     * @param string $usedType
     * @param int $id
     * @return Model|null
     */
    public function findByUsedType(string $usedType, int $id);

    /**
     * @param string $usedType
     * @return Model[]|Collection
     */
    public function getEnableByUsedType(string $usedType);
}
