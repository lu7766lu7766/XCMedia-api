<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/9
 * Time: 下午 03:05
 */

namespace Modules\Member\Contracts;

use Modules\Classified\Contracts\IClassifiedEntity;

interface ICollectible extends IClassifiedEntity
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphToMany
     */
    public function myFavorite();
}
