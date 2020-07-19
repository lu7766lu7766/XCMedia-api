<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/3
 * Time: 下午 02:50
 */

namespace Modules\Video\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Base\Entities\BaseORM;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Entities\AVActress;
use Modules\Classified\Entities\AvActressPerformances;
use Modules\Classified\Entities\Cup;
use Modules\Classified\Entities\Genres;
use Modules\Classified\Entities\GenresUsed;
use Modules\Classified\Entities\Region;
use Modules\Classified\Entities\Years;
use Modules\Files\Entities\EditorFilesUsedHelper;

/**
 * Class AdultVideo
 * @package Modules\Video\Entities
 * @property string title
 * @property string alias
 * @property string cover_path
 * @property string cover_url
 * @property array tags
 * @property string description
 * @property string status
 * @property Region source
 * @property AVActress[]|Collection actress
 * @property Years years
 * @property Cup cup
 * @property Genres[]|Collection genres
 */
class AdultVideo extends BaseORM
{
    use GenresUsed, AvActressPerformances, EditorFilesUsedHelper;
    /** @internal */
    protected $table = 'adult_video';
    /** @internal */
    protected $fillable = [
        'title',
        'alias',
        'tags',
        'description',
        'status',
        'cover_path',
        'cover_url',
        'views',
        'score'
    ];
    /** @internal */
    protected $casts = ['tags' => 'array'];

    /**
     * @return BelongsTo
     */
    public function source()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * @return BelongsTo
     */
    public function cup()
    {
        return $this->belongsTo(Cup::class, 'cup_id');
    }

    /**
     * @return BelongsTo
     */
    public function years()
    {
        return $this->belongsTo(Years::class, 'years_id');
    }

    /**
     * @return HasOne
     */
    public function bucket()
    {
        return $this->hasOne(AdultVideoBucket::class, 'adult_video_id');
    }

    /**
     * @return string
     */
    public function getClassified(): string
    {
        return ClassifiedConstant::VIDEO;
    }
}
