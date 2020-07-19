<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/12
 * Time: 下午 12:06
 */

namespace Modules\Episode\Entities;

trait EpisodesUsed
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function episodes()
    {
        return $this->morphMany(Episode::class, 'media', 'media_type', 'media_id');
    }
}
