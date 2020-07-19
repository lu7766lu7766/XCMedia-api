<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 06:55
 */

namespace Modules\Photograph\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Base\Entities\BaseORM;

/**
 * Class PhotographPhoto
 * @package Modules\Photograph\Entities
 * @property string name
 * @property string file_path
 * @property string file_url
 * @property PhotographAlbum album
 */
class PhotographPhoto extends BaseORM
{
    /** @internal */
    protected $table = 'photograph_photo';
    /** @internal */
    protected $fillable = [
        'name',
        'file_path',
        'file_url',
    ];

    /**
     * @return BelongsTo
     */
    public function album()
    {
        return $this->belongsTo(PhotographAlbum::class, 'photograph_album_id');
    }
}
