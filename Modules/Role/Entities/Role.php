<?php

namespace Modules\Role\Entities;

use Illuminate\Database\Eloquent\Collection;
use Modules\Account\Entities\Account;
use Modules\Base\Entities\BaseORM;
use Modules\Node\Entities\Node;

/**
 * @property string code
 * @property Node[]|Collection nodes
 */
class Role extends BaseORM
{
    protected $table = 'role';
    protected $fillable = [
        'display_name',
        'description',
        'code',
        'public',
        'enable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'account_role', 'role_id', 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nodes()
    {
        return $this->belongsToMany(Node::class, 'role_node', 'role_id', 'node_id')
            ->withPivot('enable')
            ->as('role_nodes')
            ->using(RoleNode::class)
            ->withTimestamps();
    }
}
