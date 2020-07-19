<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/5
 * Time: 下午 06:11
 */

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MyFavorite extends Pivot
{
    protected $table = 'my_favorite';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function media()
    {
        return $this->morphTo('media');
    }
}
