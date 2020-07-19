<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2018/10/26
 * Time: 下午 05:06
 */

namespace Modules\Role\Contract;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IRoleProvider
{
    /**
     * Get roles.
     * @return Model[]|Collection
     */
    public function get();

    /**
     * @param string $code
     * @return Model|null
     */
    public function firstByCode(string $code);

    /**
     * Get roles by role ids.
     * @param array $ids
     * @return Model[]|Collection
     */
    public function getByIds(array $ids);
}
