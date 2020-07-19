<?php
/**
 * Created by PhpStorm.
 * User: MID-House
 * Date: 2017/6/26
 * Time: 下午 04:16
 */

namespace Modules\Base\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Base\Support\Traits\AttributesSetIgnoreNull;
use Modules\Base\Support\Traits\ORMDocHelp;
use Modules\Base\Support\Traits\ORMForeignKeyHelp;

/**
 * Class BaseORM
 * @package Mid\CommonTools\Base\House\ORM
 */
abstract class BaseORM extends Model
{
    use AttributesSetIgnoreNull, ORMDocHelp, ORMForeignKeyHelp;
}
