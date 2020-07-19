<?php

namespace Modules\Comic\Entities;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Entities\BaseORM;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Entities\GenresUsed;
use Modules\Classified\Entities\Region;
use Modules\Classified\Entities\Years;
use Modules\Files\Entities\EditorFilesUsedHelper;

/**
 * Class Comic
 * @package Modules\Comic\Entities
 * @property string image_path
 * @property ComicEpisode|Collection episodes
 * @property string image_url
 */
class Comic extends BaseORM
{
    use EditorFilesUsedHelper, GenresUsed;
    protected $table = 'comic';
    protected $fillable = [
        'name',
        'alias',
        'image_path',
        'image_url',
        'episode_status',
        'status',
        'region_id',
        'years_id',
        'tags',
        'description',
        'views',
        'score'
    ];
    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function years()
    {
        return $this->belongsTo(Years::class, 'years_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function episodes()
    {
        return $this->hasMany(ComicEpisode::class, 'comic_id', 'id');
    }

    /**
     * @return string
     */
    public function getClassified(): string
    {
        return ClassifiedConstant::COMIC;
    }
}
