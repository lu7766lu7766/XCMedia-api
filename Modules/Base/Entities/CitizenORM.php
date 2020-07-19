<?php
/**
 * Created by PhpStorm.
 * User: MID-House
 * Date: 2017/6/26
 * Time: 下午 04:16
 */

namespace Modules\Base\Entities;

use Illuminate\Foundation\Auth\User;
use Modules\Base\Support\Traits\ORMDocHelp;
use Modules\Base\Support\Traits\ORMForeignKeyHelp;

/**
 * Class CitizenORM
 * @package Modules\Base\Entities
 */
abstract class CitizenORM extends User
{
    use ORMDocHelp, ORMForeignKeyHelp;
}
