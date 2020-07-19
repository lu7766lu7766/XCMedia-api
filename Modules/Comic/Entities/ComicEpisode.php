<?php

namespace Modules\Comic\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Base\Entities\BaseORM;

/**
 * Class ComicEpisode
 * @package Modules\Comic\Entities
 * @property ComicGallery[]|Collection gallery
 * @property Comic comic
 */
class ComicEpisode extends BaseORM
{
    protected $table = 'comic_episode';
    protected $fillable = [
        'comic_id',
        'title',
        'opening_time',
        'status',
        'views'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function gallery()
    {
        return $this->belongsToMany(
            ComicGallery::class,
            'comic_episode_gallery',
            'comic_episode_id',
            'comic_gallery_id'
        )->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function comic()
    {
        return $this->belongsTo(Comic::class, 'comic_id', 'id');
    }
}
