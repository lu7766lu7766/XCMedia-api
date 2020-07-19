<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/20
 * Time: 下午 04:24
 */

namespace Modules\Base\Support\Traits;

use Closure;
use Illuminate\Database\Eloquent\Builder as ORMBuilder;

/**
 * Trait ORMDocHelp
 * @package Modules\Base\Support\Traits
 * @method static null|$this find($id)
 * @method static null|$this first($columns = ['*'])
 * @method static null|$this create(array $attributes = [])
 * @method increment($column, $amount = 1, array $extra = [])
 * @method static ORMBuilder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static ORMBuilder whereKey($id)
 * @method static ORMBuilder whereIn($column, $value = null, $boolean = 'and', $not = false)
 * @method static ORMBuilder whereHas($relation, Closure $callback = null, $operator = '>=', $count = 1)
 * @method static ORMBuilder with($relations)
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
trait ORMDocHelp
{
}
