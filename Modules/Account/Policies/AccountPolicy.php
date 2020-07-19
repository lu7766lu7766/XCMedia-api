<?php

namespace Modules\Account\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\NodeCodeConstants;
use Modules\Node\Contract\IGate;

class AccountPolicy
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
    public function manage()
    {
        return $this->gate->hasAccess(NodeCodeConstants::ACCOUNT_MANAGE);
    }

    /**
     * @return bool
     */
    public function manageRead()
    {
        return $this->gate->hasAccess(NodeCodeConstants::ACCOUNT_MANAGE_READ);
    }

    /**
     * @return bool
     */
    public function manageCreate()
    {
        return $this->gate->hasAccess(NodeCodeConstants::ACCOUNT_MANAGE_CREATE);
    }

    /**
     * @return bool
     */
    public function manageUpdate()
    {
        return $this->gate->hasAccess(NodeCodeConstants::ACCOUNT_MANAGE_UPDATE);
    }

    /**
     * @return bool
     */
    public function manageDel()
    {
        return $this->gate->hasAccess(NodeCodeConstants::ACCOUNT_MANAGE_DELETE);
    }

    /**
     * @return bool
     */
    public function loginHistoryRead()
    {
        return $this->gate->hasAccess(NodeCodeConstants::ACCOUNT_LOGIN_HISTORY_READ);
    }
}
