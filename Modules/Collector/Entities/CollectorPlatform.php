<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 06:55
 */

namespace Modules\Collector\Entities;

use Modules\Base\Entities\BaseORM;

class CollectorPlatform extends BaseORM
{
    protected $table = 'collector_platform';
    protected $fillable = [
        'title',
        'code',
        'status',
    ];
}
