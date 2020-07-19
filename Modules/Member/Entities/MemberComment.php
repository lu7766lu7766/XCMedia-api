<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/17
 * Time: 下午 01:06
 */

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberComment extends Pivot
{
    protected $table = 'member_comment';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function media()
    {
        return $this->morphTo('commented');
    }
}
