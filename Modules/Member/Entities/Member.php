<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/5
 * Time: 下午 01:31
 */

namespace Modules\Member\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Modules\Account\Constants\AccountStatusConstants;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Entities\CitizenORM;
use Modules\Branch\Entities\Branch;
use Modules\Episode\Entities\Episode;

/**
 * Class Member
 * @package Modules\Member\Entities
 * @property string account
 * @property string password
 * @property string phone
 * @property string phone_approve
 * @property string mail
 * @property string mail_approve
 * @property string remark
 * @property MemberLoginHistory[]|Collection loginHistory
 * @property MyFavorite[]|Collection myFavorite
 * @property Episode[]|Collection viewedEpisode
 */
class Member extends CitizenORM
{
    use HasApiTokens, SoftDeletes;
    protected $table = 'member';
    protected $softDelete = true;
    protected $fillable = [
        'branch_id',
        'account',
        'password',
        'display_name',
        'status',
        'mail',
        'mail_approve',
        'phone',
        'phone_approve',
        'remark'
    ];
    protected $hidden = [
        'password'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loginHistory()
    {
        return $this->hasMany(MemberLoginHistory::class, 'member_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function myFavorite()
    {
        return $this->hasMany(MyFavorite::class, 'member_id', 'id');
    }

    /**
     * Used by passport issue token.
     * @param string $account
     * @param string|null $domain
     * @return $this|null.
     */
    public function findForPassport(string $account, string $domain = null)
    {
        return self::where('account', $account)
            ->whereHas('branch', function (Builder $query) use ($domain) {
                $query->where('domain', $domain)
                    ->where('status', NYEnumConstants::YES);
            })->where('status', AccountStatusConstants::ENABLE)
            ->first();
    }

    /**
     * @return MorphToMany
     */
    public function viewedEpisode()
    {
        return $this->morphedByMany(Episode::class, 'media', 'member_viewed')->withTimestamps();
    }
}
