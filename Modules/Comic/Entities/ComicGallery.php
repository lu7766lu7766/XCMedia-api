<?php

namespace Modules\Comic\Entities;

use Modules\Base\Entities\BaseORM;

/**
 * Class ComicGallery
 * @package Modules\Comic\Entities
 * @property string file_path
 */
class ComicGallery extends BaseORM
{
    protected $table = 'comic_gallery';
    protected $fillable = [
        'name',
        'alias',
        'file_path',
        'file_url'
    ];
}
