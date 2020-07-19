<?php

namespace Modules\Selfie\Entities;

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
 * Class Selfie
 * @package Modules\Selfie\Entities
 * @property Cup cup
 * @property Years years
 * @property Region region
 * @property AVActress[]|Collection actress
 * @property Genres[]|Collection genres
 * @property string title
 * @property string cover_path
 * @property string cover_url
 * @property string alias
 * @property string is_censored
 * @property array tags
 * @property string description
 * @property string status
 * @property SelfieVideo[]|Collection videos
 */
class SelfieSchedule extends BaseORM
{
    use GenresUsed, AvActressPerformances;
    /** @internal */
    protected $table = 'selfie_schedule';
    /** @internal */
    protected $fillable = [
        'title',
        'cover_path',
        'cover_url',
        'alias',
        'is_censored',
        'tags',
        'description',
        'status',
        'views',
        'score'
    ];
    /** @internal */
    protected $casts = ['tags' => 'array'];

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
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * @return HasMany
     */
    public function videos()
    {
        return $this->hasMany(SelfieVideo::class, 'selfie_schedule_id');
    }

    /**
     * @return string
     */
    public function getClassified(): string
    {
        return ClassifiedConstant::SELFIE;
    }
}
