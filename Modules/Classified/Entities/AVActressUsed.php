<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/18
 * Time: 下午 05:54
 */

namespace Modules\Classified\Entities;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait AVActressUsed
{
    /**
     * @return MorphToMany
     */
    public function avActress()
    {
        return $this->morphToMany(
            AVActress::class,
            'av_actress_used',
            'av_actress_used',
            'av_actress_used_id',
            'av_actress_id'
        );
    }
}
