<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/13
 * Time: 下午 04:22
 */

namespace Modules\Branch\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait PublishBranchHelper
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function branches()
    {
        return $this->morphToMany(
            Branch::class,
            'published_source',
            'published_branch',
            'published_source_id',
            'branch_id'
        );
    }

    /**
     * @param Collection|Model|array $branches
     */
    public function publishBranches($branches)
    {
        $this->branches()->sync($branches);
    }

    /**
     *
     */
    public function cancelBranches()
    {
        $this->branches()->detach();
    }
}
