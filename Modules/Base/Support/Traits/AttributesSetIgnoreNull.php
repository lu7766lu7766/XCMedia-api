<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/8/28
 * Time: 下午 04:44
 */

namespace Modules\Base\Support\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait AttributesSetIgnoreNull
 * @package Modules\Base\Support\Traits
 * @mixin Model
 */
trait AttributesSetIgnoreNull
{
    /**
     * Column never be null or be set to null.
     * @var array
     */
    protected $notNull = [];

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->notNull) && is_null($value)) {
            return $this;
        }

        return parent::setAttribute($key, $value);
    }
}
