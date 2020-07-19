<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/7
 * Time: 上午 11:24
 */

namespace Modules\Collector\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CollectorPlatformPivot extends Pivot
{
    protected $table = 'collector_platform_pivot';
    protected $fillable = [
        'source_id',
        'platform_id',
    ];
}
