<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/4/28
 * Time: 下午 03:29
 */

namespace Modules\Member\Entities;

use Modules\Base\Entities\BaseORM;

/**
 * @property string code
 * @property string account
 * @property string status
 */
class PhoneApprove extends BaseORM
{
    protected $table = 'phone_approve';
    protected $fillable = [
        'account',
        'code',
    ];
}
