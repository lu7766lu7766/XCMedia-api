<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/6/26
 * Time: 下午 06:22
 */

namespace Modules\Node\Contract;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface INodeProvider
{
    /**
     * Get Nodes by node ids.
     * @param array $ids
     * @return Model[]|Collection
     */
    public function getByIds(array $ids);

    /**
     * Get Nodes.
     * @return Model[]|Collection
     */
    public function get();
}
