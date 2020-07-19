<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/26
 * Time: 下午 04:10
 */

namespace Modules\Node\Repository;

use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Node\Entities\Node;

class ManageNodeRepo
{
    /**
     * @param Node $orm
     * @param array $attributes
     * @return bool
     */
    public function save(Node $orm, array $attributes)
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
     * @return Node|null
     */
    public function findByCode(string $code)
    {
        $result = null;
        try {
            $result = Node::where('code', $code)->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
