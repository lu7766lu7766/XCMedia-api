<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/4
 * Time: 上午 10:18
 */

namespace Modules\Literature\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Literature\GenresSettingNodeCodeConstants;
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
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::LITERATURE_GENRES_SETTING_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::LITERATURE_GENRES_SETTING_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::LITERATURE_GENRES_SETTING_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::LITERATURE_GENRES_SETTING_DELETE);
    }
}
