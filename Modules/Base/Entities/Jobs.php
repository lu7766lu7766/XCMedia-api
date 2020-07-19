<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2019/8/29
 * Time: 下午 03:36
 */

namespace Modules\Base\Entities;

class Jobs extends BaseORM
{
    /**
     * @var string
     */
    protected $table = 'jobs';
    /**
     * @var array
     */
    protected $hidden = [
        'payload',
        'attempts',
        'reserved_at'
    ];
}
