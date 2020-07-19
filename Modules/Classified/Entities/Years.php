<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/20
 * Time: 下午 06:39
 */

namespace Modules\Classified\Entities;

use Modules\Base\Entities\BaseORM;

class Years extends BaseORM
{
    protected $table = 'years';
    protected $fillable = [
        'title',
        'contents',
        'status',
        'used_type',
        'remark'
    ];
}
