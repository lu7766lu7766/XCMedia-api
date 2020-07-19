<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/14
 * Time: 下午 03:37
 */

namespace Modules\Classified\Entities;

trait GenresUsed
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphToMany
     */
    public function genres()
    {
        return $this->morphToMany(Genres::class, 'genres_used', 'genres_used', 'genres_used_id', 'genres_id');
    }

    /**
     * @return string
     */
    abstract public function getClassified(): string;
}
