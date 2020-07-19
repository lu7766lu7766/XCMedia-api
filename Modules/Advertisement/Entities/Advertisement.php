<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/9
 * Time: 下午 03:44
 */

namespace Modules\Advertisement\Entities;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Base\Entities\BaseORM;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Entities\PublishBranchHelper;
use Nwidart\Modules\Collection;

/**
 * Class Advertisement
 * @property string image_path
 * @package Modules\Advertisement\Entities
 * @property Branch[]|Collection owner
 */
class Advertisement extends BaseORM
{
    use PublishBranchHelper;
    protected $table = 'advertisement';
    protected $fillable = [
        'title',
        'url',
        'image_path',
        'image_url',
        'is_blank',
        'status',
        'type_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(AdvertisementType::class, 'type_id');
    }

    /**
     * @return MorphToMany
     */
    public function owner()
    {
        return $this->morphToMany(Branch::class, 'published_source', 'published_branch');
    }
}
