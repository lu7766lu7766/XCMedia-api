<?php

namespace Modules\Passport\Listeners;

use Laravel\Passport\Events\AccessTokenCreated;
use Modules\Passport\Repository\TokenManagerRepository;

class RevokeOldAccessToken
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AccessTokenCreated $event
     * @return void
     * @throws \Exception
     */
    public function handle(AccessTokenCreated $event)
    {
        $tokenRepo = app(TokenManagerRepository::class);
        $tokenRepo->chainRevoke($event->tokenId, $event->userId, $event->clientId);
    }
}
