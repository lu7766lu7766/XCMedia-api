<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/12
 * Time: 下午 03:47
 */

namespace Modules\Episode\Contracts;

use Illuminate\Database\Eloquent\Model;

interface IEpisodeOwnerRepo
{
    /**
     * @param int $id
     * @return Model|null
     */
    public function getOwner(int $id): ?Model;
}
