<?php

namespace Modules\Movie\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Movie\YearsSettingNodeCodeConstants;
use Modules\Node\Contract\IGate;

class YearsSettingPolicy
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
        return $this->gate->hasAccess(YearsSettingNodeCodeConstants::MOVIE_YEARS_SETTING_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(YearsSettingNodeCodeConstants::MOVIE_YEARS_SETTING_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(YearsSettingNodeCodeConstants::MOVIE_YEARS_SETTING_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(YearsSettingNodeCodeConstants::MOVIE_YEARS_SETTING_DELETE);
    }
}
