<?php

namespace Modules\Account\Entities;

use Modules\Base\Entities\BaseORM;

class AccountLoginLog extends BaseORM
{
    protected $table = 'account_login_log';
    protected $fillable = [
        'account_id',
        'login_ip'
    ];
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
