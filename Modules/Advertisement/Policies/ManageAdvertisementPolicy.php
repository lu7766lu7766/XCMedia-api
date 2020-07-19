<?php

namespace Modules\Advertisement\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\NodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageAdvertisementPolicy
{
    use HandlesAuthorization;
    /**
     * @var IGate
     */
    private $gate;

    /**
     * Create a new policy instance.
     *
     * @param IGate $gate
     */
    public function __construct(IGate $gate)
    {
        $this->gate = $gate;
    }

    /**
     * @return bool
     */
    public function read()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_ADVERTISEMENT_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_ADVERTISEMENT_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_ADVERTISEMENT_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_ADVERTISEMENT_DELETE);
    }

    /**
     * @return bool
     */
    public function branchList()
    {
        return $this->gate->anyAccess([
            NodeCodeConstants::MANAGE_ADVERTISEMENT_CREATE,
            NodeCodeConstants::MANAGE_ADVERTISEMENT_UPDATE
        ]);
    }
}
