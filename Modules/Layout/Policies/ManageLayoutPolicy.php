<?php

namespace Modules\Layout\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\LayoutNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageLayoutPolicy
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
        return $this->gate->hasAccess(LayoutNodeCodeConstants::MANAGE_LAYOUT_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(LayoutNodeCodeConstants::MANAGE_LAYOUT_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(LayoutNodeCodeConstants::MANAGE_LAYOUT_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(LayoutNodeCodeConstants::MANAGE_LAYOUT_DELETE);
    }

    /**
     * @return bool
     */
    public function branchList()
    {
        return $this->gate->anyAccess([
            LayoutNodeCodeConstants::MANAGE_LAYOUT_CREATE,
            LayoutNodeCodeConstants::MANAGE_LAYOUT_UPDATE
        ]);
    }

    /**
     * @return bool
     */
    public function editFile()
    {
        return $this->gate->anyAccess([
            LayoutNodeCodeConstants::MANAGE_LAYOUT_CREATE,
            LayoutNodeCodeConstants::MANAGE_LAYOUT_UPDATE
        ]);
    }
}
