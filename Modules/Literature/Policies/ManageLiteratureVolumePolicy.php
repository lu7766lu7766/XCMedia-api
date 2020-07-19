<?php

namespace Modules\Literature\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Constants\Literature\ManageLiteratureVolumeNodeCodeConstants;
use Modules\Node\Contract\IGate;

class ManageLiteratureVolumePolicy
{
    use HandlesAuthorization;
    /** @var IGate $gate */
    private $gate;

    /**
     * ManageLiteratureVolumePolicy constructor.
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
        return $this->gate->hasAccess(ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME_READ);
    }

    /**
     * @return bool
     */
    public function edit(): bool
    {
        return $this->gate->hasAccess(ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME_UPDATE);
    }

    /**
     * @return bool
     */
    public function add(): bool
    {
        return $this->gate->hasAccess(ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME_CREATE);
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        return $this->gate->hasAccess(ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME_DELETE);
    }

    /**
     * @return bool
     */
    public function upload(): bool
    {
        return $this->gate->anyAccess([
            ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME_CREATE,
            ManageLiteratureVolumeNodeCodeConstants::MANAGE_LITERATURE_VOLUME_UPDATE
        ]);
    }
}
