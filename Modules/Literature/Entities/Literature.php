<?php

namespace Modules\Literature\Entities;

use Modules\Base\Entities\BaseORM;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Entities\GenresUsed;
use Modules\Classified\Entities\Region;
use Modules\Classified\Entities\Years;
use Modules\Files\Entities\EditorFilesUsedHelper;

/**
 * Class Literature
 * @package Modules\Literature\Entities
 * @property string cover_url
 * @property string cover_path
 */
class Literature extends BaseORM
{
    use GenresUsed, EditorFilesUsedHelper;
    protected $table = 'literature';
    protected $fillable = [
        'cover_url',
        'title',
        'region_id',
        'year_id',
        'views',
        'status',
        'cover_path',
        'alias',
        'description',
        'tags',
        'score'
    ];

    /**
     * @return string
     */
    public function getClassified(): string
    {
        return ClassifiedConstant::LITERATURE;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function year()
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function volume()
    {
        return $this->hasMany(LiteratureVolume::class);
    }
}
