<?php

namespace Modules\Variety\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Variety\ManageVarietyNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageVarietyPolicy
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
        return $this->gate->hasAccess(ManageVarietyNodeCodeConstants::MANAGE_VARIETY_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(ManageVarietyNodeCodeConstants::MANAGE_VARIETY_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(ManageVarietyNodeCodeConstants::MANAGE_VARIETY_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(ManageVarietyNodeCodeConstants::MANAGE_VARIETY_DELETE);
    }

    /**
     * @return bool
     */
    public function episodeRead()
    {
        return $this->gate->hasAccess(ManageVarietyNodeCodeConstants::MANAGE_VARIETY_EPISODE_READ);
    }

    /**
     * @return bool
     */
    public function episodeCreate()
    {
        return $this->gate->hasAccess(ManageVarietyNodeCodeConstants::MANAGE_VARIETY_EPISODE_CREATE);
    }

    /**
     * @return bool
     */
    public function episodeUpdate()
    {
        return $this->gate->hasAccess(ManageVarietyNodeCodeConstants::MANAGE_VARIETY_EPISODE_UPDATE);
    }

    /**
     * @return bool
     */
    public function episodeDelete()
    {
        return $this->gate->hasAccess(ManageVarietyNodeCodeConstants::MANAGE_VARIETY_EPISODE_DELETE);
    }

    /**
     * @return bool
     */
    public function editFile()
    {
        return $this->gate->anyAccess([
            ManageVarietyNodeCodeConstants::MANAGE_VARIETY_CREATE,
            ManageVarietyNodeCodeConstants::MANAGE_VARIETY_UPDATE
        ]);
    }
}
