<?php

namespace Modules\Movie\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Movie\ManageMovieNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageMoviePolicy
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
        return $this->gate->hasAccess(ManageMovieNodeCodeConstants::MANAGE_MOVIE_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(ManageMovieNodeCodeConstants::MANAGE_MOVIE_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(ManageMovieNodeCodeConstants::MANAGE_MOVIE_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(ManageMovieNodeCodeConstants::MANAGE_MOVIE_DELETE);
    }

    /**
     * @return bool
     */
    public function episodeRead()
    {
        return $this->gate->hasAccess(ManageMovieNodeCodeConstants::MANAGE_MOVIE_EPISODE_READ);
    }

    /**
     * @return bool
     */
    public function episodeCreate()
    {
        return $this->gate->hasAccess(ManageMovieNodeCodeConstants::MANAGE_MOVIE_EPISODE_CREATE);
    }

    /**
     * @return bool
     */
    public function episodeUpdate()
    {
        return $this->gate->hasAccess(ManageMovieNodeCodeConstants::MANAGE_MOVIE_EPISODE_UPDATE);
    }

    /**
     * @return bool
     */
    public function episodeDelete()
    {
        return $this->gate->hasAccess(ManageMovieNodeCodeConstants::MANAGE_MOVIE_EPISODE_DELETE);
    }

    /**
     * @return bool
     */
    public function editFile()
    {
        return $this->gate->anyAccess([
            ManageMovieNodeCodeConstants::MANAGE_MOVIE_CREATE,
            ManageMovieNodeCodeConstants::MANAGE_MOVIE_UPDATE
        ]);
    }
}
