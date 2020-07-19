<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Modules\Account\Constants\AccountStatusConstants;
use Modules\Base\Entities\CitizenORM;
use Modules\Role\Entities\Role;

/**
 * Class Account
 * @property string account
 * @property string password
 * @property AccountCover|null cover
 * @package Modules\Account\Entities
 */
class Account extends CitizenORM
{
    use HasApiTokens, SoftDeletes;
    protected $table = 'account';
    protected $softDelete = true;
    protected $fillable = [
        'account',
        'display_name',
        'status',
        'mail',
        'phone',
        'login_ip',
        'remark'
    ];
    protected $casts = ['remark' => 'json'];
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'account_role', 'account_id', 'role_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loginLog()
    {
        return $this->hasMany(AccountLoginLog::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cover()
    {
        return $this->hasOne(AccountCover::class);
    }

    /**
     * Used by passport issue token.
     * @param string $account
     * @return $this|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null.
     */
    public function findForPassport(string $account)
    {
        return self::where('account', $account)
            ->where('status', AccountStatusConstants::ENABLE)
            ->first();
    }
}
