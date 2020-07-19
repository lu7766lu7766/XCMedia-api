<?php

namespace Modules\Passport\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Http\Controllers\ConvertsPsrResponses;
use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\PasswordGrant;
use Modules\Account\Entities\Account;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Passport\Http\Requests\PersonalTokenGenerateRequest;
use Modules\Passport\OAuth2\MemberRepository;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response as Psr7Response;

class PassportController extends Controller
{
    use ConvertsPsrResponses;
    /**
     * @var AuthorizationServer
     */
    private $server;

    public function __construct(AuthorizationServer $server)
    {
        $this->server = $server;
    }

    /**
     * Authorize a client to access the user's account.
     * It expire in now add 3 day.
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Illuminate\Http\Response
     * @throws \League\OAuth2\Server\Exception\OAuthServerException
     */
    public function issueToken(ServerRequestInterface $request)
    {
        Passport::tokensExpireIn(now()->addDays(3));
        $token = $this->convertResponse(
            $this->server->respondToAccessTokenRequest($request, new Psr7Response)
        );

        return $token;
    }

    /**
     * @param ServerRequestInterface $request
     * @return \Illuminate\Http\Response
     * @throws ApiErrorCodeException
     * @throws \League\OAuth2\Server\Exception\OAuthServerException
     */
    public function memberIssueToken(ServerRequestInterface $request)
    {
        if (!$request->hasHeader('User-Agent')) {
            throw new ApiErrorCodeException(OOOO1CommonCodes::HEADER_USER_AGENT_IS_REQUIRED);
        }
        Passport::tokensExpireIn(now()->addDays(3));
        $grantType = app(
            PasswordGrant::class,
            [
                'userRepository'         => app(MemberRepository::class),
                'refreshTokenRepository' => app(RefreshTokenRepository::class)
            ]
        );
        $this->server->enableGrantType($grantType);
        $token = $this->convertResponse(
            $this->server->respondToAccessTokenRequest($request, new Psr7Response)
        );

        return $token;
    }

    /**
     * 令牌有效期三年
     * @param PersonalTokenGenerateRequest $request
     * @param ClientRepository $client
     * @return array
     */
    public function personalTokenGenerate(PersonalTokenGenerateRequest $request, ClientRepository $client)
    {
        Passport::tokensExpireIn(now()->addYears(3));
        /** @var Account $user */
        $user = \Auth::user();
        $userClient = $client->activeForUser($user->getAuthIdentifier())->first();
        if (is_null($userClient)) {
            $client->createPersonalAccessClient(
                $user->getAuthIdentifier(),
                $user->account . '_personal_client',
                ''
            );
        }
        $token = $user->createToken($request->getDescription());

        return [
            'token' => $token->accessToken,
            'name'  => $token->token->getAttribute('name')
        ];
    }
}
