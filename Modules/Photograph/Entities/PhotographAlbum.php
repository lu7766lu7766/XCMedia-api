<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 02:33
 */

namespace Modules\Photograph\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Base\Entities\BaseORM;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Entities\AVActress;
use Modules\Classified\Entities\AvActressPerformances;
use Modules\Classified\Entities\Cup;
use Modules\Classified\Entities\Genres;
use Modules\Classified\Entities\GenresUsed;
use Modules\Classified\Entities\Region;
use Modules\Classified\Entities\Years;

/**
 * Class PhotographAlbum
 * @package Modules\Photograph\Entities
 * @property string title
 * @property string cover_path
 * @property string cover_url
 * @property string alias
 * @property array tags
 * @property string description
 * @property string status
 * @property Region region
 * @property Cup cup
 * @property Years years
 * @property PhotographPhoto photo
 * @property AVActress[]|Collection actress
 * @property Genres[]|Collection genres
 */
class PhotographAlbum extends BaseORM
{
    use AvActressPerformances, GenresUsed;
    /** @internal */
    protected $casts = ['tags' => 'array'];
    /** @internal */
    protected $table = 'photograph_album';
    /** @internal */
    protected $fillable = [
        'title',
        'cover_path',
        'cover_url',
        'alias',
        'tags',
        'description',
        'status',
        'views',
        'score'
    ];

    /**
     * @return BelongsTo
     */
    public function region()
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
     * @return HasMany
     */
    public function photo()
    {
        return $this->hasMany(PhotographPhoto::class, 'photograph_album_id');
    }

    /**
     * @return string
     */
    public function getClassified(): string
    {
        return ClassifiedConstant::PHOTOGRAPH;
    }
}
