<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 06:41
 */

namespace Modules\Collector\Entities\MacCMS;

use Modules\Base\Entities\BaseORM;

/**
 * @property string type_name
 * @property integer type_id
 */
class MacType extends BaseORM
{
    public $connection = 'macdb';
    protected $table = 'mac_type';
}
