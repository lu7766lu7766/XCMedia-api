<?php

namespace Modules\Movie\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Movie\SourceSettingNodeCodeConstants;
use Modules\Node\Contract\IGate;

class SourceSettingPolicy
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
        return $this->gate->hasAccess(SourceSettingNodeCodeConstants::MOVIE_SOURCE_SETTING_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(SourceSettingNodeCodeConstants::MOVIE_SOURCE_SETTING_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(SourceSettingNodeCodeConstants::MOVIE_SOURCE_SETTING_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(SourceSettingNodeCodeConstants::MOVIE_SOURCE_SETTING_DELETE);
    }
}
