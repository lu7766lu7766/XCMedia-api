<?php

namespace Modules\Account\Tests;

use Modules\Account\Service\ManageAccountService;
use Modules\Base\Exception\ApiErrorCodeException;
use Tests\TestCase;

class AccountEditServiceTest extends TestCase
{
    /**
     * 測試新增帳號
     */
    public function testCreate()
    {
        $account = null;
        $service = ManageAccountService::getInstance([
            'account'      => 'house',
            'password'     => 'house1234',
            'display_name' => 'housebombom',
            'mail'         => 'house@house.cc',
            'phone'        => '3939889',
        ]);
        try {
            $account = $service->create();
        } catch (ApiErrorCodeException $e) {
        } catch (\Throwable $e) {
        }
        $this->assertTrue(is_object($account));
    }

    /**
     * 測試更新帳號
     */
    public function testUpdate()
    {
        $account = null;
        $service = ManageAccountService::getInstance([
            'id'           => 1,
            'account'      => 'house',
            'password'     => 'house1234',
            'display_name' => 'housewawa',
            'mail'         => 'house@house.cc',
            'phone'        => '3939889',
        ]);
        try {
            $account = $service->update();
        } catch (ApiErrorCodeException $e) {
        } catch (\Throwable $e) {
        }
        $this->assertTrue(is_object($account));
    }
}
