<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/5
 * Time: 下午 04:14
 */

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Base\Entities\BaseORM;

/**
 * Trait Viewed
 * @package Modules\Member\Entities
 * @mixin BaseORM
 */
trait MediaViewed
{
    /**
     * @return MorphToMany
     */
    public function reader()
    {
        return $this->morphToMany(Member::class, 'media', 'member_viewed')->withTimestamps();
    }
}
