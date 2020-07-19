<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/14
 * Time: 下午 04:41
 */

namespace Modules\Anime\Entities;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
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
 * Class Anime
 * @package Modules\Anime\Entities
 * @property string title
 * @property string alias
 * @property string image_path
 * @property string image_url
 * @property string episode_status
 * @property string status
 * @property string starring
 * @property string director
 * @property integer region_id
 * @property integer years_id
 * @property integer language_id
 * @property string description
 * @property integer views
 */
class Anime extends BaseORM implements ICommentEntity, ICollectible
{
    use EditorFilesUsedHelper, EpisodesUsed, GenresUsed, MyFavoriteRelation, MemberCommentRelation;
    protected $table = 'anime';
    protected $fillable = [
        'title',
        'alias',
        'image_path',
        'image_url',
        'episode_status',
        'status',
        'starring',
        'director',
        'region_id',
        'genres_id',
        'years_id',
        'language_id',
        'description',
        'views',
        'score'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function years()
    {
        return $this->belongsTo(Years::class, 'years_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    /**
     * @return string
     */
    public function getClassified(): string
    {
        return ClassifiedConstant::ANIME;
    }

    /**
     * @return MorphToMany
     */
    public function collector()
    {
        return $this->morphToMany(Member::class, 'media', 'my_favorite');
    }
}
