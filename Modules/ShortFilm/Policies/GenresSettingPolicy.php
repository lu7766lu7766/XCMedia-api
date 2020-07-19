<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/3
 * Time: 下午 03:10
 */

namespace Modules\ShortFilm\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\ShortFilm\GenresSettingNodeCodeConstants;
use Modules\Node\Contract\IGate;

class GenresSettingPolicy
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
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::SHORT_FILM_GENRES_SETTING_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::SHORT_FILM_GENRES_SETTING_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::SHORT_FILM_GENRES_SETTING_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::SHORT_FILM_GENRES_SETTING_DELETE);
    }
}

