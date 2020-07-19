<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/8
 * Time: 下午 03:56
 */

namespace Modules\Branch\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Constants\NYEnumConstants;

interface IBranchProvider
{
    /**
     * @param array $ids
     * @return Model[]|Collection
     */
    public function getByIds(array $ids);

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id);

    /**
     * @param string $domain
     * @param string $status
     * @param string $isRegister
     * @return Model|null
     */
    public function findByDomain(
        string $domain,
        string $status = NYEnumConstants::YES,
        string $isRegister = NYEnumConstants::YES
    );
}
