<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/13
 * Time: 上午 11:50
 */

namespace Modules\Storytelling\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Storytelling\ManageStorytellingNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageStorytellingAudioPolicy
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
        return $this->gate->hasAccess(ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_AUDIO_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_AUDIO_CREATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_AUDIO_DELETE);
    }
}
