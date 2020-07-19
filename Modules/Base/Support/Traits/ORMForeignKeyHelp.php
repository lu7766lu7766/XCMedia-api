<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/20
 * Time: 下午 04:33
 */

namespace Modules\Base\Support\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Trait ORMForeignKeyHelp
 * @package Modules\Base\Support\Traits
 * @mixin Model
 */
trait ORMForeignKeyHelp
{
    private static $FOREIGN = null;

    /**
     * @return string
     */
    public function getForeignKey()
    {
        /** @noinspection PhpUndefinedClassInspection */
        return static::$FOREIGN ?? parent::getForeignKey();
    }
}
