<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 06:44
 */

namespace Modules\Collector\Entities;

use Modules\Base\Entities\BaseORM;

class CollectorType extends BaseORM
{
    protected $table = 'collector_type';
    protected $fillable = [
        'title',
        'status',
    ];
}
