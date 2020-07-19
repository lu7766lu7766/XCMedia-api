<?php

namespace Modules\Comic\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Comic\ManageComicNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageComicPolicy
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
        return $this->gate->hasAccess(ManageComicNodeCodeConstants::MANAGE_COMIC_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(ManageComicNodeCodeConstants::MANAGE_COMIC_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(ManageComicNodeCodeConstants::MANAGE_COMIC_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(ManageComicNodeCodeConstants::MANAGE_COMIC_DELETE);
    }

    /**
     * @return bool
     */
    public function options()
    {
        return $this->gate->anyAccess([
            ManageComicNodeCodeConstants::MANAGE_COMIC_READ,
            ManageComicNodeCodeConstants::MANAGE_COMIC_CREATE,
            ManageComicNodeCodeConstants::MANAGE_COMIC_UPDATE
        ]);
    }

    /**
     * @return bool
     */
    public function episodeRead()
    {
        return $this->gate->hasAccess(ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE_READ);
    }

    /**
     * @return bool
     */
    public function episodeCreate()
    {
        return $this->gate->hasAccess(ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE_CREATE);
    }

    /**
     * @return bool
     */
    public function episodeUpdate()
    {
        return $this->gate->hasAccess(ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE_UPDATE);
    }

    /**
     * @return bool
     */
    public function episodeDelete()
    {
        return $this->gate->hasAccess(ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE_DELETE);
    }

    /**
     * @return bool
     */
    public function editFile()
    {
        return $this->gate->anyAccess([
            ManageComicNodeCodeConstants::MANAGE_COMIC_CREATE,
            ManageComicNodeCodeConstants::MANAGE_COMIC_UPDATE
        ]);
    }

    /**
     * @return bool
     */
    public function editEpisodeFile()
    {
        return $this->gate->anyAccess([
            ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE_CREATE,
            ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE_UPDATE
        ]);
    }
}
