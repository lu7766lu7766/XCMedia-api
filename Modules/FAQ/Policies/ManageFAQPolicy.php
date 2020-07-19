<?php

namespace Modules\FAQ\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\FAQNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageFAQPolicy
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
        return $this->gate->hasAccess(FAQNodeCodeConstants::MANAGE_FAQ_READ);
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess(FAQNodeCodeConstants::MANAGE_FAQ_CREATE);
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess(FAQNodeCodeConstants::MANAGE_FAQ_UPDATE);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess(FAQNodeCodeConstants::MANAGE_FAQ_DELETE);
    }

    /**
     * @return bool
     */
    public function branchList()
    {
        return $this->gate->anyAccess([
            FAQNodeCodeConstants::MANAGE_FAQ_CREATE,
            FAQNodeCodeConstants::MANAGE_FAQ_UPDATE
        ]);
    }

    /**
     * @return bool
     */
    public function editFile()
    {
        return $this->gate->anyAccess([
            FAQNodeCodeConstants::MANAGE_FAQ_CREATE,
            FAQNodeCodeConstants::MANAGE_FAQ_UPDATE
        ]);
    }
}
