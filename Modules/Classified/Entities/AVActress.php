<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 上午 11:25
 */

namespace Modules\Classified\Entities;

use Modules\Base\Entities\BaseORM;

/**
 * Class AVActress
 * @package Modules\Classified\Entities
 * @property string name
 * @property string alias
 * @property string image_path
 * @property string image_url
 * @property string status
 * @property string note
 * @property string used_type
 */
class AVActress extends BaseORM
{
    protected $table = 'av_actress';
    protected $fillable = [
        'name',
        'alias',
        'image_path',
        'image_url',
        'status',
        'note',
        'used_type',
    ];
}
