<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 05:38
 */

namespace Modules\Collector\Entities\MacCMS;

use Modules\Base\Entities\BaseORM;

/**
 * @property string collect_name
 * @property string collect_url
 * @property int collect_id
 */
class MacCollect extends BaseORM
{
    public $connection = 'macdb';
    protected $table = 'mac_collect';
}
