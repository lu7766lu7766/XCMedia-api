<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/11
 * Time: 下午 06:44
 */

namespace Modules\Episode\Entities;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Base\Entities\BaseORM;
use Modules\Classified\Entities\Source;
use Modules\Episode\Contracts\Entire\IEpisode;
use Modules\Member\Entities\MediaViewed;

/**
 * Class Episode
 * @package Modules\Episode\Entities
 * @property string $title
 */
class Episode extends BaseORM implements IEpisode
{
    use MediaViewed;
    protected $table = 'episode';
    protected $fillable = [
        'title',
        'opening_time',
        'views',
        'status',
        'episode_type',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sources()
    {
        return $this->belongsToMany(Source::class, 'episode_source', 'episode_id', 'source_id')
            ->withPivot(['url'])->as('sources_url');
    }

    /**
     * @return MorphTo
     */
    public function series(): MorphTo
    {
        return $this->morphTo('media');
    }
}
