<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/27
 * Time: 下午 01:05
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IGenresProvider
{
    /**
     * @param string $usedType
     * @return Model[]|Collection
     */
    public function getEnableUsedType(string $usedType);

    /**
     * @param array $ids
     * @param string $type
     * @return Model[]|Collection
     */
    public function getByUsedTyp(array $ids, string $type);
}
