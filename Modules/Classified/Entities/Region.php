<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/1/30
 * Time: 下午 05:24
 */

namespace Modules\Classified\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Base\Entities\BaseORM;
use Modules\Video\Entities\AdultVideo;

/**
 * Class Region
 * @package Modules\Classified\Entities
 * @property AdultVideo[]|Collection adultVideo
 */
class Region extends BaseORM
{
    protected $table = 'region';
    protected $fillable = [
        'name',
        'status',
        'note',
        'used_type',
    ];

    /**
     * @return HasMany
     */
    public function adultVideo()
    {
        return $this->hasMany(AdultVideo::class);
    }
}
