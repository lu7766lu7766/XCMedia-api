<?php

namespace Modules\Collector\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\CollectorNodConstants;
use Modules\Node\Contract\IGate;

class ManageCollectorPolicy
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
        return $this->gate->hasAccess(CollectorNodConstants::MANAGE_COLLECTOR_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(CollectorNodConstants::MANAGE_COLLECTOR_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(CollectorNodConstants::MANAGE_COLLECTOR_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(CollectorNodConstants::MANAGE_COLLECTOR_DELETE);
    }
}
