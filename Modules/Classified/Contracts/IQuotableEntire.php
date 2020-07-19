<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 下午 04:41
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Base\Entities\BaseORM;

/**
 * Interface IQuotableEntire
 * @package Modules\Classified\Contracts
 * @mixin BaseORM
 */
interface IQuotableEntire
{
    /**
     * @return BelongsToMany
     */
    public function quote(): BelongsToMany;
}
