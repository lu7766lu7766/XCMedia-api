<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/14
 * Time: 下午 04:49
 */

namespace Modules\Member\Listeners;

use Jenssegers\Agent\Agent;
use Laravel\Passport\Events\AccessTokenCreated;
use Modules\Base\Constants\ApiCode\OOOO1CommonCodes;
use Modules\Base\Constants\ApiCode\OOOO4MemberCode;
use Modules\Base\Exception\ApiErrorCodeException;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Member\Repositories\MemberRepo;
use Venuscn\Client;

class MemberLoginRecord
{
    /** @var array|\Illuminate\Http\Request|string $req */
    private $req;
    /** @var MemberRepo $repo */
    private $repo;

    /**
     * Create the event listener.
     *
     * @param MemberRepo $repo
     */
    public function __construct(MemberRepo $repo)
    {
        $this->req = request();
        $this->repo = $repo;
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
        if ($this->isMemberLogin()) {
            $member = $this->repo->find($event->userId);
            if (is_null($member)) {
                throw new ApiErrorCodeException(OOOO4MemberCode::MEMBER_NOT_FOUND, 'MEMBER NOT FOUND');
            }
            try {
                $ip = $this->req->ip();
                $attributes = [
                    'login_ip' => $this->req->ip(),
                    'device'   => (new Agent())->platform(),
                    'browser'  => $this->req->userAgent(),
                ];
                if (!is_null($ip)) {
                    $client = new Client(config('Member.config.ip_api_key'));
                    $response = $client->mine($ip);
                    $attributes['isp'] = $response->getISP();
                    $attributes['location'] = $response->getCountry() . $response->getRegion();
                    $attributes['extra'] = $response->all();
                }
                $member->loginHistory()->create($attributes);
            } catch (\Throwable $e) {
                LaravelLoggerUtil::loggerException($e);
                throw  new ApiErrorCodeException(OOOO1CommonCodes::CREATE_FAIL);
            }
        }
    }

    /**
     * @return bool
     */
    private function isMemberLogin()
    {
        return $this->req->routeIs('member.passport.login');
    }
}
