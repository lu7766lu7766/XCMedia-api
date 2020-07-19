<?php

namespace Modules\Literature\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Literature\ManageLiteratureNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageLiteraturePolicy
{
    use HandlesAuthorization;
    /** @var IGate $gate */
    private $gate;

    /**
     * ManageLiteraturePolicy constructor.
     * @param IGate $gate
     */
    public function __construct(IGate $gate)
    {
        $this->gate = $gate;
    }

    /**
     * @return bool
     */
    public function read(): bool
    {
        return $this->gate->hasAccess(ManageLiteratureNodeCodeConstants::MANAGE_LITERATURE_READ);
    }

    /**
     * @return bool
     */
    public function edit(): bool
    {
        return $this->gate->hasAccess(ManageLiteratureNodeCodeConstants::MANAGE_LITERATURE_UPDATE);
    }

    /**
     * @return bool
     */
    public function add(): bool
    {
        return $this->gate->hasAccess(ManageLiteratureNodeCodeConstants::MANAGE_LITERATURE_CREATE);
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        return $this->gate->hasAccess(ManageLiteratureNodeCodeConstants::MANAGE_LITERATURE_DELETE);
    }

    /**
     * @return bool
     */
    public function upload(): bool
    {
        return $this->gate->anyAccess([
            ManageLiteratureNodeCodeConstants::MANAGE_LITERATURE_CREATE,
            ManageLiteratureNodeCodeConstants::MANAGE_LITERATURE_UPDATE
        ]);
    }
}
