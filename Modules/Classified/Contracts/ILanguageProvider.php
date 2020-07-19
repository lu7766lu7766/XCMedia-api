<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/4/1
 * Time: 上午 11:03
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ILanguageProvider
{
    /**
     * @param string $usedType
     * @return Collection|Model[]
     */
    public function getAllByUsedType(string $usedType): Collection;
}
