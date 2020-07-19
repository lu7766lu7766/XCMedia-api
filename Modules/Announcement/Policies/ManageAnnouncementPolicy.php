<?php

namespace Modules\Announcement\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\NodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageAnnouncementPolicy
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
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_ANNOUNCEMENT_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_ANNOUNCEMENT_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_ANNOUNCEMENT_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_ANNOUNCEMENT_DELETE);
    }

    /**
     * @return bool
     */
    public function branchList()
    {
        return $this->gate->anyAccess([
            NodeCodeConstants::MANAGE_ANNOUNCEMENT_CREATE,
            NodeCodeConstants::MANAGE_ANNOUNCEMENT_UPDATE
        ]);
    }

    /**
     * @return bool
     */
    public function editFile()
    {
        return $this->gate->anyAccess([
            NodeCodeConstants::MANAGE_ANNOUNCEMENT_CREATE,
            NodeCodeConstants::MANAGE_ANNOUNCEMENT_UPDATE
        ]);
    }
}
