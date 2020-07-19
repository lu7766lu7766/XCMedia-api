<?php

namespace Modules\Account\Listeners;

use Illuminate\Http\Request;
use Laravel\Passport\Events\AccessTokenCreated;
use Modules\Account\Entities\Account;
use Modules\Account\Entities\AccountLoginLog;

class AccountLoginRecord
{
    /**
     * @var Request
     */
    private $req;

    /**
     * Create the event listener.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->req = $request;
    }

    /**
     * Handle the event.
     *
     * @param AccessTokenCreated $event
     * @return void
     * @throws \Throwable
     */
    public function handle(AccessTokenCreated $event)
    {
        if ($this->isAdminLogin()) {
            \DB::transaction(function () use ($event) {
                $attribute = ['login_ip' => $this->req->ip()];
                app(Account::class)->where('id', $event->userId)->update($attribute);
                $attribute['account_id'] = $event->userId;
                app(AccountLoginLog::class)->fill($attribute)->save();
            });
        }
    }

    /**
     * @return bool
     */
    private function isAdminLogin()
    {
        return $this->req->routeIs('passport.login');
    }
}
