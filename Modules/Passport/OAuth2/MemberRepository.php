<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/15
 * Time: 上午 10:56
 */

namespace Modules\Passport\OAuth2;

use Illuminate\Hashing\HashManager;
use Illuminate\Http\Request;
use Laravel\Passport\Bridge\User;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Modules\Member\Entities\Member;

class MemberRepository implements UserRepositoryInterface
{
    /** @var HashManager $hash */
    protected $hash;
    /** @var Request $request */
    private $request;

    /**
     * MemberRepository constructor.
     * @param HashManager $hash
     * @param Request $request
     */
    public function __construct(HashManager $hash, Request $request)
    {
        $this->hash = $hash;
        $this->request = $request;
    }

    /**
     * Get a user entity.
     *
     * @param string $username
     * @param string $password
     * @param string $grantType The grant type used
     * @param ClientEntityInterface $clientEntity
     *
     * @return UserEntityInterface|null
     */
    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $grantType,
        ClientEntityInterface $clientEntity
    ) {
        $result = null;
        /** @var Member|null $member */
        $member = app(Member::class)->findForPassport(
            $username,
            parse_url($this->request->header('referer'), PHP_URL_HOST)
        );
        if (!is_null($member) && $this->hash->check($password, $member->getAuthPassword())) {
            $result = new User($member->getAuthIdentifier());
        }

        return $result;
    }
}
