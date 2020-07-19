<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/5
 * Time: 下午 06:54
 */

namespace Modules\Base\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Node\Contract\IGate;

abstract class CRUDPolicy
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
     * @return string
     */
    abstract protected function readNode(): string;

    /**
     * @return string
     */
    abstract protected function createNode(): string;

    /**
     * @return string
     */
    abstract protected function updateNode(): string;

    /**
     * @return string
     */
    abstract protected function deleteNode(): string;

    /**
     * @return bool
     */
    public function read()
    {
        return $this->gate->hasAccess($this->readNode());
    }

    /**
     * @return bool
     */
    public function create()
    {
        return $this->gate->hasAccess($this->createNode());
    }

    /**
     * @return bool
     */
    public function update()
    {
        return $this->gate->hasAccess($this->updateNode());
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->gate->hasAccess($this->deleteNode());
    }
}
