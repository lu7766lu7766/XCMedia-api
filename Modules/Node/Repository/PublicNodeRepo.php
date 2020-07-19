<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/6/26
 * Time: 下午 06:24
 */

namespace Modules\Node\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Node\Contract\INodeProvider;
use Modules\Node\Entities\Node;
use Modules\Node\Entities\NodeGroup;

class PublicNodeRepo implements INodeProvider
{
    /**
     * Get Nodes by node ids.
     * @param array $ids
     * @return Node[]|Collection
     */
    public function getByIds(array $ids)
    {
        $result = collect();
        try {
            $result = Node::where('public', NYEnumConstants::YES)
                ->where('enable', NYEnumConstants::YES)
                ->whereIn('id', $ids)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     * @return NodeGroup[]|Collection
     */
    public function get()
    {
        try {
            $result = NodeGroup::with([
                'nodes' => function (HasMany $builder) {
                    $builder->where('node.public', NYEnumConstants::YES)
                        ->where('node.enable', NYEnumConstants::YES);
                }
            ])
                ->where('public', NYEnumConstants::YES)
                ->where('enable', NYEnumConstants::YES)
                ->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
