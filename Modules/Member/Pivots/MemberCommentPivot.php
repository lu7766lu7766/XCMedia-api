<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 下午 12:10
 */

namespace Modules\Member\Pivots;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Base\Entities\BaseORM;
use Modules\Member\Entities\Member;

/**
 * Class MemberCommentPivot
 * @package Modules\Member\Pivots
 * @property Member member
 * @property Model commentAble
 * @mixin BaseORM
 */
class MemberCommentPivot extends Pivot
{
    /** @internal */
    protected $table = 'member_comment';

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
    public function commentAble()
    {
        return $this->morphTo('commented');
    }
}
