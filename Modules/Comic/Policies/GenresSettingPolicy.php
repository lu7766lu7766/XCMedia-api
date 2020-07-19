<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/4
 * Time: 上午 09:38
 */

namespace Modules\Comic\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Comic\GenresSettingNodeCodeConstants;
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
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::COMIC_GENRES_SETTING_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::COMIC_GENRES_SETTING_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::COMIC_GENRES_SETTING_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(GenresSettingNodeCodeConstants::COMIC_GENRES_SETTING_DELETE);
    }
}
