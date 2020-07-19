<?php

namespace Modules\Movie\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Movie\LanguageSettingNodeCodeConstants;
use Modules\Node\Contract\IGate;

class LanguageSettingPolicy
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
        return $this->gate->hasAccess(LanguageSettingNodeCodeConstants::MOVIE_LANGUAGE_SETTING_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(LanguageSettingNodeCodeConstants::MOVIE_LANGUAGE_SETTING_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(LanguageSettingNodeCodeConstants::MOVIE_LANGUAGE_SETTING_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(LanguageSettingNodeCodeConstants::MOVIE_LANGUAGE_SETTING_DELETE);
    }
}
