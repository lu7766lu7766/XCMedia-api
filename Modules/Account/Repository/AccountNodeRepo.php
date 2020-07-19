<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/7/18
 * Time: 下午 05:53
 */

namespace Modules\Account\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Node\Entities\Node;
use Modules\Node\Entities\NodeGroup;

class AccountNodeRepo
{
    /**
     * @param int $id 帳號id
     * @return Node[]|Collection
     */
    public function enableNodes(int $id)
    {
        $result = collect();
        try {
            $nodes = Node::whereHas('roles.accounts', function (Builder $builder) use ($id) {
                $builder->where('role.enable', NYEnumConstants::YES)
                    ->where('role_node.enable', NYEnumConstants::YES)
                    ->where('account.id', $id);
            })->where('enable', NYEnumConstants::YES)
                ->get();
            if ($nodes->isNotEmpty()) {
                $ids = $nodes->pluck('id')->toArray();
                $result = NodeGroup::with([
                    'nodes' => function (HasMany $builder) use ($ids) {
                        $builder->whereIn('node.id', $ids)
                            ->where('node.enable', NYEnumConstants::YES);
                    }
                ])
                    ->whereHas('nodes', function (Builder $builder) use ($ids) {
                        $builder->whereIn('node.id', $ids);
                    })
                    ->where('public', NYEnumConstants::YES)
                    ->where('enable', NYEnumConstants::YES)
                    ->get();
            }
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
