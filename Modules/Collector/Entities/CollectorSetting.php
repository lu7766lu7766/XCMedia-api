<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 04:00
 */

namespace Modules\Collector\Entities;

use Modules\Base\Entities\BaseORM;

class CollectorSetting extends BaseORM
{
    protected $table = 'collector_setting';
    protected $fillable = [
        'collector_source_id',
        'status',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source()
    {
        return $this->belongsTo(CollectorSource::class, 'collector_source_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function platform()
    {
        return $this->belongsToMany(CollectorPlatform::class, 'collector_platform_pivot', 'setting_id', 'platform_id');
    }

    public function type()
    {
        return $this->belongsToMany(CollectorType::class, 'collector_type_pivot', 'setting_id', 'type_id');
    }
}

