<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/8
 * Time: 下午 04:54
 */

namespace Modules\Advertisement\Entities;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Entities\BaseORM;

/**
 * Class AdvertisementType
 * @package Modules\Advertisement\Entities
 * @property Advertisement[]|Collection advertisement
 * @property string size_hint
 */
class AdvertisementType extends BaseORM
{
    protected $table = 'advertisement_type';
    protected $fillable = [
        'name',
        'size_hint'
    ];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertisement()
    {
        return $this->hasMany(Advertisement::class, 'type_id');
    }
}
