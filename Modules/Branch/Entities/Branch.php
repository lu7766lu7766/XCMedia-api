<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/2
 * Time: 下午 04:34
 */

namespace Modules\Branch\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Advertisement\Entities\Advertisement;
use Modules\Base\Entities\BaseORM;
use Modules\Member\Entities\Member;

/**
 * Class Branch
 * @package Modules\Branch\Entities
 * @property Member[]|Collection member
 * @property Advertisement[]|Collection advertisement
 */
class Branch extends BaseORM
{
    use SoftDeletes;
    protected $table = 'branch';
    protected $fillable = [
        'code',
        'name',
        'domain',
        'status',
        'is_register',
        'remark',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function member()
    {
        return $this->hasMany(Member::class, 'branch_id', 'id');
    }

    /**
     * @return MorphToMany
     */
    public function advertisement()
    {
        return $this->morphedByMany(Advertisement::class, 'published_source', 'published_branch');
    }
}
