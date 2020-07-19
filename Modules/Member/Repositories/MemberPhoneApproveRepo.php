<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/4/28
 * Time: 下午 05:13
 */

namespace Modules\Member\Repositories;

use Carbon\Carbon;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Member\Entities\PhoneApprove;

class MemberPhoneApproveRepo
{
    /**
     * @param string $account
     * @param string $code
     * @return PhoneApprove|null
     */
    public function find(string $account, string $code)
    {
        $result = null;
        try {
            $time = Carbon::now()->subMinutes(20);
            $result = PhoneApprove::where('account', $account)
                ->where('updated_at', '>=', $time)
                ->where('code', $code)
                ->where('status', NYEnumConstants::NO)
                ->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
