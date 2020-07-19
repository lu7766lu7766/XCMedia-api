<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 04:08
 */

namespace Modules\Classified\Service;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Classified\Contracts\ILeaderBoardProvider;
use Modules\Classified\Http\Requests\Client\LeaderBoardIndexRequest;

class LeaderBoardService
{
    /** @var ILeaderBoardProvider $repo */
    private $repo;

    /**
     * LeaderBoardService constructor.
     * @param ILeaderBoardProvider $repo
     */
    public function __construct(ILeaderBoardProvider $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param LeaderBoardIndexRequest $request
     * @return Collection|Model[]
     */
    public function list(LeaderBoardIndexRequest $request): Collection
    {
        return $this->repo->getPopular($request->getTopCount())->load([
            'episodes' => function (MorphMany $builder) {
                $builder->where('episode.status', NYEnumConstants::YES)
                    ->where('opening_time', '<=', Carbon::now());
            }
        ]);
    }
}
