<?php

namespace Modules\Node\Entities;

use Modules\Base\Entities\BaseORM;
use Modules\Role\Entities\Role;

/**
 * Class Node
 * @property int node_group_id
 * @property string path
 * @package Modules\Node\Entities
 */
class Node extends BaseORM
{
    protected $table = 'node';
    protected $fillable = [
        'enable',
        'display',
        'display_name',
        'public',
        'node_group_id',
        'code'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_node', 'node_id', 'role_id')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(NodeGroup::class, 'node_group_id', 'id', 'node_group');
    }
}
