<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/24
 * Time: 下午 02:34
 */

namespace Modules\Passport\Repository;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Laravel\Passport\TokenRepository;

class TokenManagerRepository
{
    /**
     * @var TokenRepository
     */
    private $token;
    /**
     * @var \Laravel\Passport\Token
     */
    private $tokenModel;
    /**
     * @var \Illuminate\Database\Connection
     */
    private $conn;

    /**
     * TokenManagerRepository constructor.
     * @param TokenRepository $token
     */
    public function __construct(TokenRepository $token)
    {
        $this->token = $token;
        $this->tokenModel = Passport::token();
        $this->conn = $this->tokenModel->getConnection();
    }

    /**
     * @return \Laravel\Passport\Token
     */
    public function getModel()
    {
        return Passport::token();
    }

    /**
     * Revoke access token and related refresh token.
     * @param string $tokenId
     * @param string $userId
     * @param string $clientId
     * @throws \Exception
     */
    public function chainRevoke(string $tokenId, string $userId, string $clientId)
    {
        /** @var \Laravel\Passport\Token $token */
        $token = $this->tokenModel->newQuery()
            ->where('user_id', $userId)
            ->where('client_id', $clientId)
            ->where('id', '<>', $tokenId)
            ->where('revoked', 0)
            ->where('expires_at', '>', Carbon::now())
            ->first();
        if (!is_null($token)) {
            try {
                $this->conn->beginTransaction();
                $token->revoke();
                $this->revokeRefreshTokenFromAccessToken($token->getKey());
                $this->conn->commit();
            } catch (\Throwable $e) {
                $this->conn->rollBack();
            }
        }
    }

    /**
     * @param string $accessToken
     */
    protected function revokeRefreshTokenFromAccessToken(string $accessToken)
    {
        $this->conn->table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken)
            ->update(['revoked' => true]);
    }
}
