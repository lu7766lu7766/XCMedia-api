<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/10
 * Time: 下午 06:48
 */

namespace Modules\Drama\Entities;

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
use Modules\Member\Entities\MemberCommentRelation;
use Modules\Member\Entities\MyFavoriteRelation;

/**
 * Class Drama
 * @property string image_path
 * @package Modules\Drama\Entities
 */
class Drama extends BaseORM implements ICommentEntity, ICollectible
{
    use EditorFilesUsedHelper, EpisodesUsed, GenresUsed, MyFavoriteRelation, MemberCommentRelation;
    protected $table = 'drama';
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
        'hits',
        'views',
        'score',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function years()
    {
        return $this->belongsTo(Years::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    /**
     * @return string
     */
    public function getClassified(): string
    {
        return ClassifiedConstant::DRAMA;
    }
}
