<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/6/27
 * Time: 下午 03:49
 */

namespace Modules\Account\Access;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Modules\Account\Entities\Account;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Node\Contract\IGate;

class NodeAccessor implements IGate
{
    /**
     * @var Account
     */
    private $user;

    /**
     * NodeAccessor constructor.
     * @param Account|Authenticatable $user
     */
    public function __construct(Account $user = null)
    {
        $this->user = $user;
    }

    /**
     * @inheritdoc
     */
    public function hasAccess(string $code)
    {
        $result = false;
        try {
            $result = !is_null($this->user) && $this->user->roles()
                    ->where('enable', NYEnumConstants::YES)
                    ->whereHas('nodes', function (Builder $builder) use ($code) {
                        $builder->where('node.code', $code)
                            ->where('node.enable', NYEnumConstants::YES)
                            ->where('role_node.enable', NYEnumConstants::YES);
                    })->exists();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function anyAccess(array $code)
    {
        $result = false;
        try {
            $result = !is_null($this->user) && $this->user->roles()
                    ->where('enable', NYEnumConstants::YES)
                    ->whereHas('nodes', function (Builder $builder) use ($code) {
                        $builder->whereIn('node.code', $code)
                            ->where('node.enable', NYEnumConstants::YES)
                            ->where('role_node.enable', NYEnumConstants::YES);
                    })->exists();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
