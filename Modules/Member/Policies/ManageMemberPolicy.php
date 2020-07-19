<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/5
 * Time: 下午 02:55
 */

namespace Modules\Member\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\NodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageMemberPolicy
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
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_MEMBER_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_MEMBER_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_MEMBER_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MANAGE_MEMBER_DELETE);
    }

    /**
     * @return bool
     */
    public function optionsList()
    {
        return $this->gate->anyAccess([
            NodeCodeConstants::MANAGE_MEMBER_READ,
            NodeCodeConstants::MANAGE_MEMBER_CREATE,
            NodeCodeConstants::MANAGE_MEMBER_UPDATE
        ]);
    }

    /**
     * @return bool
     */
    public function history()
    {
        return $this->gate->hasAccess(NodeCodeConstants::MEMBER_LOGIN_HISTORY_READ);
    }
}
