<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/6/27
 * Time: 下午 03:11
 */

namespace Modules\Node\Contract;

use Modules\Node\Constants\NodeCodeConstants;

interface IGate
{
    /**
     * @param string $code
     * @return bool
     * @see NodeCodeConstants
     */
    public function hasAccess(string $code);

    /**
     * @param array $code
     * @return bool
     */
    public function anyAccess(array $code);
}
