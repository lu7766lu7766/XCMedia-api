<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 上午 11:16
 */

namespace Modules\Classified\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Base\Entities\BaseORM;
use Modules\Selfie\Entities\SelfieSchedule;

/**
 * Class Cup
 * @package Modules\Classified\Entities
 * @property string size
 * @property string status
 * @property string note
 * @property string used_type
 * @property SelfieSchedule[]|Collection selfie
 */
class Cup extends BaseORM
{
    protected $table = 'cup';
    protected $fillable = [
        'size',
        'status',
        'note',
        'used_type',
    ];

    /**
     * @return HasMany
     */
    public function selfie()
    {
        return $this->hasMany(SelfieSchedule::class);
    }
}
