<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 05:02
 */

namespace Modules\Collector\Entities;

use Modules\Base\Entities\BaseORM;

class CollectorSource extends BaseORM
{
    protected $table = 'collector_source';
    protected $fillable = [
        'collector_source_id',
        'status',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function setting()
    {
        return $this->hasMany(CollectorSetting::class, 'collector_source_id', 'id');
    }
}
