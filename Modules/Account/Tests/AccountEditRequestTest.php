<?php

namespace Modules\Account\Tests;

use Modules\Account\Http\Requests\Manage\AccountCreateRequest;
use Modules\Account\Http\Requests\Manage\AccountUpdateRequest;
use Modules\Base\Exception\ApiErrorCodeException;
use Tests\TestCase;

class AccountEditRequestTest extends TestCase
{
    public function testCreateRequest()
    {
        try {
            $handle = AccountCreateRequest::getHandle([
                'account'      => 'house',
                'password'     => 'house1234',
                'display_name' => 'housebombom',
                'mail'         => 'house@house.cc',
                'phone'        => '3939889',
            ]);
            $this->assertTrue($handle instanceof AccountCreateRequest);
        } catch (ApiErrorCodeException $e) {
            var_export($e->getCodes());
        }
    }

    public function testUpdateRequest()
    {
        try {
            $handle = AccountUpdateRequest::getHandle([
                'id' => 1
            ]);
            $this->assertTrue($handle instanceof AccountUpdateRequest);
        } catch (ApiErrorCodeException $e) {
            var_export($e->getCodes());
        }
    }
}
