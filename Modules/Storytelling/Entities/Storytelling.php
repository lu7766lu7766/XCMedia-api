<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/11
 * Time: 下午 03:17
 */

namespace Modules\Storytelling\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Base\Entities\BaseORM;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Entities\Genres;
use Modules\Classified\Entities\GenresUsed;
use Modules\Classified\Entities\Region;
use Modules\Classified\Entities\Years;
use Modules\Files\Entities\EditorFilesUsedHelper;

/**
 * Class Storytelling
 * @package Modules\Storytelling\Entities
 * @property Years years
 * @property Region region
 * @property Genres[]|Collection genres
 * @property string title
 * @property string cover_path
 * @property string cover_url
 * @property string alias
 * @property array tags
 * @property string description
 * @property string status
 * @property StorytellingAudio audio
 */
class Storytelling extends BaseORM
{
    use GenresUsed, EditorFilesUsedHelper;
    /** @internal */
    protected $table = 'storytelling';
    /** @internal */
    protected $fillable = [
        'title',
        'cover_path',
        'cover_url',
        'alias',
        'tags',
        'description',
        'region_id',
        'genres_id',
        'years_id',
        'status',
        'views',
        'score'
    ];
    /** @internal */
    protected $casts = ['tags' => 'array'];

    /**
     * @return BelongsTo
     */
    public function years()
    {
        return $this->belongsTo(Years::class, 'years_id');
    }

    /**
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * @return string
     */
    public function getClassified(): string
    {
        return ClassifiedConstant::STORYTELLING;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function audio()
    {
        return $this->hasMany(StorytellingAudio::class, 'storytelling_id');
    }
}
