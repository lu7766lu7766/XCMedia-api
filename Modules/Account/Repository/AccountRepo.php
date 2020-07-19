<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2019/6/27
 * Time: 下午 05:58
 */

namespace Modules\Account\Repository;

use Modules\Account\Entities\Account;
use Modules\Base\Util\LaravelLoggerUtil;

class AccountRepo
{
    /**
     * 新增帳號
     * @param array $attribute
     * @param string $password
     * @return Account|null
     */
    public function create(array $attribute, string $password)
    {
        try {
            $result = new Account($attribute);
            $result->password = \Hash::make($password);
            $result->save();
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * 編輯帳號
     * @param Account $account 帳號id
     * @param array $attribute
     * @param string|null $password
     * @return bool
     */
    public function update(Account $account, array $attribute, string $password = null)
    {
        try {
            if (!is_null($password)) {
                $account->password = \Hash::make($password);
            }
            $result = $account->fill($attribute)->save();
        } catch (\Throwable $e) {
            return null;
        }

        return $result;
    }

    /**
     * @param int $id
     * @return Account|null
     */
    public function find(int $id)
    {
        $result = null;
        try {
            $result = Account::find($id);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
