<?php

namespace Modules\Movie\Entities;

use Modules\Base\Entities\BaseORM;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Entities\GenresUsed;
use Modules\Classified\Entities\Language;
use Modules\Classified\Entities\Region;
use Modules\Classified\Entities\Years;
use Modules\Episode\Entities\EpisodesUsed;
use Modules\Files\Entities\EditorFilesUsedHelper;
use Modules\Member\Contracts\ICollectible;
use Modules\Member\Contracts\ICommentEntity;
use Modules\Member\Entities\Member;
use Modules\Member\Entities\MemberCommentRelation;
use Modules\Member\Entities\MyFavoriteRelation;

/**
 * Class Movie
 * @package Modules\Movie\Entities
 * @property string image_path
 * @property string image_url
 */
class Movie extends BaseORM implements ICommentEntity, ICollectible
{
    use EditorFilesUsedHelper, EpisodesUsed, GenresUsed, MyFavoriteRelation, MemberCommentRelation;
    protected $table = 'movie';
    protected $fillable = [
        'name',
        'alias',
        'image_path',
        'image_url',
        'episode_status',
        'status',
        'region_id',
        'years_id',
        'language_id',
        'starring',
        'director',
        'description',
        'views',
        'score'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    /**
     * @return string
     */
    public function getClassified(): string
    {
        return ClassifiedConstant::MOVIE;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function collector()
    {
        return $this->morphToMany(Member::class, 'media', 'my_favorite');
    }
}
