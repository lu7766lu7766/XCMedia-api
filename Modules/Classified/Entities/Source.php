<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/17
 * Time: 下午 03:55
 */

namespace Modules\Classified\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Base\Entities\BaseORM;
use Modules\Classified\Contracts\IQuotableEntire;
use Modules\Episode\Entities\Episode;

/**
 * Class Source
 * @package Modules\Classified\Entities
 */
class Source extends BaseORM implements IQuotableEntire
{
    protected $table = 'source';
    protected $fillable = [
        'title',
        'contents',
        'status',
        'used_type',
        'remark',
        'analyze_address'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function quote(): BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'episode_source', 'source_id', 'episode_id')->withPivot('url');
    }

    /**
     * @return BelongsToMany
     */
    public function episode()
    {
        return $this->belongsToMany(Episode::class, 'episode_source', 'source_id', 'episode_id')
            ->withPivot('url')->as('sources_url');
    }
}
