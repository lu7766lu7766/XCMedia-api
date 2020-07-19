<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/6/26
 * Time: 下午 06:18
 */

namespace Modules\Role\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Node\Entities\Node;
use Modules\Node\Entities\NodeGroup;
use Modules\Role\Entities\Role;

/**
 * Class RoleNodeRepo handle node relation.
 * @package Modules\Role\Repository
 */
class RoleNodeRepo
{
    /**
     * Get Nodes by node ids.
     * @param array $ids
     * @return Node[]
     */
    public function getPublicNodesByNodeIds(array $ids)
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
     * @param Role $role
     * @param array|Node[]|Collection $ids
     * @return array
     */
    public function bindNodesByIds(Role $role, $ids)
    {
        $result = [];
        try {
            \DB::transaction(function () use ($role, $ids, &$result) {
                $result = $role->nodes()->sync($ids);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Role $role
     * @param Node $node
     * @return array
     */
    public function bindNode(Role $role, Node $node)
    {
        $result = [];
        try {
            $result = $role->nodes()->syncWithoutDetaching($node);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Role $role
     * @return NodeGroup[]|Collection
     */
    public function loadPublicNodes(Role $role)
    {
        try {
            $role->load([
                'nodes' => function (Relation $builder) {
                    $builder->where('node.public', NYEnumConstants::YES)
                        ->where('node.enable', NYEnumConstants::YES)
                        ->where('role_node.enable', NYEnumConstants::YES);
                }
            ]);
            $result = NodeGroup::with([
                'nodes' => function (HasMany $builder) use ($role) {
                    $builder->whereIn('node.id', $role->nodes->pluck('id'));
                }
            ])
                ->whereHas('nodes', function (Builder $builder) use ($role) {
                    $builder->whereIn('node.id', $role->nodes->pluck('id'));
                })
                ->where('public', NYEnumConstants::YES)
                ->where('enable', NYEnumConstants::YES)
                ->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Role $role
     * @return Node[]|Collection
     */
    public function loadUnPublicNodes(Role $role)
    {
        try {
            $role->load([
                'nodes' => function (Relation $builder) {
                    $builder->where('public', NYEnumConstants::NO);
                }
            ]);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $role->nodes;
    }
}
