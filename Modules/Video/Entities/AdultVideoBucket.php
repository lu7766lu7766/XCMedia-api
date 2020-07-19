<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 02:30
 */

namespace Modules\Video\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Base\Entities\BaseORM;

/**
 * Class AdultVideoBucket
 * @package Modules\Video\Entities
 * @property string file_path
 * @property string file_url
 * @property string release_time
 * @property string status
 * @property AdultVideo headline
 */
class AdultVideoBucket extends BaseORM
{
    /** @internal */
    protected $table = 'adult_video_bucket';
    /** @internal */
    protected $fillable = [
        'file_path',
        'file_url',
        'release_time',
        'status',
    ];

    /**
     * @return BelongsTo
     */
    public function headline()
    {
        return $this->belongsTo(AdultVideo::class, 'adult_video_id');
    }
}
