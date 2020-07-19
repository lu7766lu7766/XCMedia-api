<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/10
 * Time: 下午 04:39
 */

namespace Modules\Video\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Video\TopicTypeNodeCodeConstants;
use Modules\Node\Contract\IGate;

class TopicTypePolicy
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
        return $this->gate->hasAccess(TopicTypeNodeCodeConstants::VIDEO_TOPIC_TYPE_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(TopicTypeNodeCodeConstants::VIDEO_TOPIC_TYPE_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(TopicTypeNodeCodeConstants::VIDEO_TOPIC_TYPE_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(TopicTypeNodeCodeConstants::VIDEO_TOPIC_TYPE_DELETE);
    }
}
