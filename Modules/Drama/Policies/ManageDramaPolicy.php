<?php

namespace Modules\Drama\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Drama\ManageDramaNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageDramaPolicy
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
        return $this->gate->hasAccess(ManageDramaNodeCodeConstants::MANAGE_DRAMA_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(ManageDramaNodeCodeConstants::MANAGE_DRAMA_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(ManageDramaNodeCodeConstants::MANAGE_DRAMA_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(ManageDramaNodeCodeConstants::MANAGE_DRAMA_DELETE);
    }

    /**
     * @return bool
     */
    public function episodeRead()
    {
        return $this->gate->hasAccess(ManageDramaNodeCodeConstants::MANAGE_DRAMA_EPISODE_READ);
    }

    /**
     * @return bool
     */
    public function episodeCreate()
    {
        return $this->gate->hasAccess(ManageDramaNodeCodeConstants::MANAGE_DRAMA_EPISODE_CREATE);
    }

    /**
     * @return bool
     */
    public function episodeUpdate()
    {
        return $this->gate->hasAccess(ManageDramaNodeCodeConstants::MANAGE_DRAMA_EPISODE_UPDATE);
    }

    /**
     * @return bool
     */
    public function episodeDelete()
    {
        return $this->gate->hasAccess(ManageDramaNodeCodeConstants::MANAGE_DRAMA_EPISODE_DELETE);
    }

    /**
     * @return bool
     */
    public function editFile()
    {
        return $this->gate->anyAccess([
            ManageDramaNodeCodeConstants::MANAGE_DRAMA_CREATE,
            ManageDramaNodeCodeConstants::MANAGE_DRAMA_UPDATE
        ]);
    }
}
