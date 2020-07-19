<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2019/12/16
 * Time: 下午 05:22
 */

namespace Modules\Node\Repository;

use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Node\Entities\NodeGroup;

class ManageNodeGroupRepo
{
    /**
     * @param NodeGroup $orm
     * @param array $attributes
     * @return bool
     */
    public function save(NodeGroup $orm, array $attributes)
    {
        $result = false;
        try {
            $result = $orm->fill($attributes)->save();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $code
     * @return NodeGroup|null
     */
    public function findByCode(string $code)
    {
        $result = null;
        try {
            $result = NodeGroup::where('code', $code)->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
