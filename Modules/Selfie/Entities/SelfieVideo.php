<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/2
 * Time: 下午 12:20
 */

namespace Modules\Selfie\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Base\Entities\BaseORM;
use Nwidart\Modules\Collection;

/**
 * Class SelfieVideo
 * @package Modules\Selfie\Entities
 * @property string name
 * @property string cover_path
 * @property string cover_url
 * @property string video_path
 * @property string video_url
 * @property string release_data
 * @property string status
 * @property SelfieSchedule[]|Collection schedule
 */
class SelfieVideo extends BaseORM
{
    /** @var array $fillable */
    protected $fillable = [
        'title',
        'cover_path',
        'cover_url',
        'video_path',
        'video_url',
        'release_date',
        'status',
    ];
    protected $table = 'selfie_video';

    /**
     * @return BelongsTo
     */
    public function schedule()
    {
        return $this->belongsTo(SelfieSchedule::class, 'selfie_schedule_id');
    }
}
