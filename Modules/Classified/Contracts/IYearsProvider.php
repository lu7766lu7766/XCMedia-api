<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/27
 * Time: 下午 12:38
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IYearsProvider
{
    /**
     * @param int $id
     * @param string $type
     * @return Model|null
     */
    public function findEnableByType(int $id, string $type);

    /**
     * @param string $type
     * @return Model[]|Collection
     */
    public function getEnableByType(string $type);
}
