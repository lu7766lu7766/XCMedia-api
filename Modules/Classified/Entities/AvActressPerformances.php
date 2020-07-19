<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 06:33
 */

namespace Modules\Classified\Entities;

use Illuminate\Database\Eloquent\Relations\morphToMany;
use Modules\Base\Entities\BaseORM;

/**
 * Trait AvActressPerformances
 * @package Modules\Classified\Entities
 * @mixin BaseORM
 */
trait AvActressPerformances
{
    /**
     * @return morphToMany
     */
    public function actress()
    {
        return $this->morphToMany(
            AVActress::class,
            'performances',
            'av_actress_performances',
            'performances_id',
            'av_actress_id'
        )->withTimestamps();
    }
}
