<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 04:30
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ILeaderBoardProvider
{
    /**
     * @param int $take
     * @return Collection|Model[]
     */
    public function getPopular(int $take): Collection;
}
