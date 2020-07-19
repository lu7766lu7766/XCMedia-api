<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/5
 * Time: 下午 07:08
 */

namespace Modules\Member\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Member\Entities\Member;

/**
 * Class MemberViewedPivot
 * @package Modules\Member\Pivots
 */
class MemberViewedPivot extends Pivot
{
    protected $table = 'member_viewed';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function readAble()
    {
        return $this->morphTo('media');
    }
}
