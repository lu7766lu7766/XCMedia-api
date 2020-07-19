<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/11
 * Time: 下午 04:40
 */

namespace Modules\Storytelling\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Contract\IGate;
use Modules\Node\Constants\Storytelling\ManageStorytellingNodeCodeConstants;

class ManageStorytellingPolicy
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
        return $this->gate->hasAccess(ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_DELETE);
    }

    /**
     * @return bool
     */
    public function editFile()
    {
        return $this->gate->anyAccess([
            ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_CREATE,
            ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_UPDATE
        ]);
    }
}
