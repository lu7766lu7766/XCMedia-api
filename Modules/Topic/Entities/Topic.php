<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/6
 * Time: 上午 09:44
 */

namespace Modules\Topic\Entities;

use Modules\Base\Entities\BaseORM;

/**
 * Class Topic
 * @package Modules\Topic\Entities
 * @property string title
 * @property string remark
 * @property string image_path
 * @property string image_url
 * @property string status
 * @property string used_type
 */
class Topic extends BaseORM
{
    protected $table = 'topic';
    protected $fillable = [
        'title',
        'remark',
        'image_path',
        'image_url',
        'status',
        'used_type'
    ];
}
