<?php

namespace Modules\ShortFilm\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\ShortFilm\ManageShortFilmNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageShortFilmPolicy
{
    use HandlesAuthorization;
    /** @var IGate $gate */
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
    public function read(): bool
    {
        return $this->gate->hasAccess(ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_READ);
    }

    /**
     * @return bool
     */
    public function add(): bool
    {
        return $this->gate->hasAccess(ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_CREATE);
    }

    /**
     * @return bool
     */
    public function edit(): bool
    {
        return $this->gate->hasAccess(ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        return $this->gate->hasAccess(ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_DELETE);
    }

    /**
     * @return bool
     */
    public function upload(): bool
    {
        return $this->gate->anyAccess([
            ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_CREATE,
            ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_UPDATE
        ]);
    }

    /**
     * @return bool
     */
    public function video(): bool
    {
        return $this->gate->hasAccess(ManageShortFilmNodeCodeConstants::MANAGE_SHORT_FILM_VIDEO);
    }
}
