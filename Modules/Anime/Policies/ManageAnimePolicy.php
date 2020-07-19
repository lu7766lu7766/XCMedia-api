<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/14
 * Time: 下午 04:56
 */

namespace Modules\Anime\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Anime\ManageAnimeNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageAnimePolicy
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
        return $this->gate->hasAccess(ManageAnimeNodeCodeConstants::MANAGE_ANIME_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(ManageAnimeNodeCodeConstants::MANAGE_ANIME_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(ManageAnimeNodeCodeConstants::MANAGE_ANIME_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(ManageAnimeNodeCodeConstants::MANAGE_ANIME_DELETE);
    }

    /**
     * @return bool
     */
    public function episodeRead()
    {
        return $this->gate->hasAccess(ManageAnimeNodeCodeConstants::MANAGE_ANIME_EPISODE_READ);
    }

    /**
     * @return bool
     */
    public function episodeCreate()
    {
        return $this->gate->hasAccess(ManageAnimeNodeCodeConstants::MANAGE_ANIME_EPISODE_CREATE);
    }

    /**
     * @return bool
     */
    public function episodeUpdate()
    {
        return $this->gate->hasAccess(ManageAnimeNodeCodeConstants::MANAGE_ANIME_EPISODE_UPDATE);
    }

    /**
     * @return bool
     */
    public function episodeDelete()
    {
        return $this->gate->hasAccess(ManageAnimeNodeCodeConstants::MANAGE_ANIME_EPISODE_DELETE);
    }

    /**
     * @return bool
     */
    public function editFile()
    {
        return $this->gate->anyAccess([
            ManageAnimeNodeCodeConstants::MANAGE_ANIME_CREATE,
            ManageAnimeNodeCodeConstants::MANAGE_ANIME_UPDATE
        ]);
    }
}
