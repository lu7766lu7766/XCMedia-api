<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/5
 * Time: 下午 02:41
 */

namespace Modules\Member\Entities;

use Modules\Base\Entities\BaseORM;

class MemberLoginHistory extends BaseORM
{
    protected $table = 'member_login_history';
    protected $casts = [
        'extra' => 'array'
    ];
    protected $fillable = [
        'member_id',
        'login_ip',
        'location',
        'isp',
        'device',
        'browser',
        'extra'
    ];
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
