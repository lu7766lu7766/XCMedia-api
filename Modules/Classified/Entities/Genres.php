<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/1/30
 * Time: 下午 02:48
 */

namespace Modules\Classified\Entities;

use Modules\Base\Entities\BaseORM;

/**
 * Class Genres
 * @package Modules\Classified\Entities
 * @property string title
 * @property string remark
 * @property string image_path
 * @property string image_url
 * @property string status
 * @property string used_type
 */
class Genres extends BaseORM
{
    protected $table = 'genres';
    protected $fillable = [
        'title',
        'remark',
        'image_path',
        'image_url',
        'status',
        'used_type'
    ];
}
