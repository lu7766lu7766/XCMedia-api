<?php

namespace Modules\Passport\Repository;

use Carbon\Carbon;
use Laravel\Passport\TokenRepository;

class TokenShrewdRepository extends TokenRepository
{
    /**
     * {@inheritdoc}
     */
    public function isAccessTokenRevoked($id)
    {
        if ($token = $this->find($id)) {
            /** @noinspection PhpUndefinedFieldInspection */
            return $token->revoked || Carbon::now()->greaterThan($token->expires_at);
        }

        return true;
    }
}
