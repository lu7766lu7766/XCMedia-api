<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/1/31
 * Time: 下午 06:11
 */

namespace Modules\Drama\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Drama\GenresSettingNodeCodeConstants;
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
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::DRAMA_GENRES_SETTING_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::DRAMA_GENRES_SETTING_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::DRAMA_GENRES_SETTING_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::DRAMA_GENRES_SETTING_DELETE);
    }
}
