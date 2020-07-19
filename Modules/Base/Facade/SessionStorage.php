<?php
/**
 * Created by PhpStorm.
 * User: MID-House
 * Date: 2017/8/8
 * Time: 下午 07:01
 */

namespace Modules\Base\Facade;

use Modules\Account\Contract\IAccountInfo;
use Modules\Base\Contract\ISessionReader;

/**
 * Class Session
 * @package Mid\LotteryBase\Facade
 * @method static IAccountInfo account()
 */
class SessionStorage
{
    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters = [])
    {
        return app(ISessionReader::class)->$method(...$parameters);
    }
}
