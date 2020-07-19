<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2019/12/16
 * Time: 上午 11:21
 */

namespace Modules\Node\Entities;

use Modules\Base\Entities\BaseORM;

class NodeGroup extends BaseORM
{
    protected $table = 'node_group';
    protected $fillable = [
        'display_name',
        'code',
        'enable',
        'display',
        'public'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nodes()
    {
        return $this->hasMany(Node::class, 'node_group_id', 'id');
    }
}
