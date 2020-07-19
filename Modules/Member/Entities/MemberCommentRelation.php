<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/10
 * Time: 下午 05:14
 */

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Base\Entities\BaseORM;

/**
 * Trait MemberCommentRelation
 * @package Modules\Member\Entities
 * @mixin BaseORM
 */
trait MemberCommentRelation
{
    /**
     * @return  MorphToMany
     */
    public function comments()
    {
        /** @var  MorphToMany $query */
        $query = $this->morphToMany(Member::class, 'commented', 'member_comment', 'commented_id', 'member_id');

        return $query->withPivot('contents')->withTimestamps();
    }
}
