<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/5
 * Time: 上午 11:43
 */

namespace Modules\Member\Entities;

trait MyFavoriteRelation
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphToMany
     */
    public function myFavorite()
    {
        return $this->morphToMany(Member::class, 'media', 'my_favorite', 'media_id', 'member_id');
    }
}
