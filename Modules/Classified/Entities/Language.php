<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/3
 * Time: 下午 07:41
 */

namespace Modules\Classified\Entities;

use Modules\Base\Entities\BaseORM;

class Language extends BaseORM
{
    protected $table = 'language';
    protected $fillable = [
        'title',
        'contents',
        'status',
        'used_type',
        'remark'
    ];
}
