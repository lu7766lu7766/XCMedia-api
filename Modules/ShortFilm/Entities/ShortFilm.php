<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/17
 * Time: 下午 03:34
 */

namespace Modules\ShortFilm\Entities;

use Modules\Base\Entities\BaseORM;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Entities\AVActressUsed;
use Modules\Classified\Entities\Cup;
use Modules\Classified\Entities\GenresUsed;
use Modules\Classified\Entities\Region;
use Modules\Classified\Entities\Years;
use Modules\Files\Entities\EditorFilesUsedHelper;

/**
 * Class ShortFilm
 * @property string cover_url
 * @property string cover_path
 * @property string video_url
 * @property string video_path
 * @package Modules\ShortFilm\Entities
 */
class ShortFilm extends BaseORM
{
    use GenresUsed, EditorFilesUsedHelper, AVActressUsed;
    protected $table = 'short_film';
    protected $fillable = [
        'title',
        'cover_path',
        'cover_url',
        'video_path',
        'video_url',
        'alias',
        'mosaic_type',
        'region_id',
        'cup_id',
        'year_id',
        'tags',
        'description',
        'status',
        'views',
        'open_at',
        'video_status',
        'score'
    ];

    /**
     * @return string
     */
    public function getClassified(): string
    {
        return ClassifiedConstant::SHORT_FILM;
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cup()
    {
        return $this->belongsTo(Cup::class);
    }
}
