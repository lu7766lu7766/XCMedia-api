<?php

namespace Modules\Role\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Node\Entities\Node;

/**
 * @property int permission
 */
class RoleNode extends Pivot
{
    protected $table = 'role_node';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nodes()
    {
        return $this->belongsTo(Node::class, 'node_id');
    }
}
