<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/27
 * Time: 下午 12:45
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IRegionProvider
{
    /**
     * @param int $id
     * @param string $type
     * @return Model|null
     */
    public function findByType(int $id, string $type);

    /**
     * @param int $id
     * @param string $type
     * @return Model|null
     */
    public function findEnableByType(int $id, string $type);

    /**
     * @param string $usedType
     * @return Model[]|Collection
     */
    public function getEnableByUsedType(string $usedType);
}
