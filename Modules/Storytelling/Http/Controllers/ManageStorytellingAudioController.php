<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/13
 * Time: 上午 11:17
 */

namespace Modules\Storytelling\Http\Controllers;

use Illuminate\Contracts\Filesystem\Cloud;
use Modules\Storytelling\Entities\StorytellingAudio;
use Modules\Storytelling\Http\Requests\Manage\StorytellingAudio\GetIdRequestHandle;
use Modules\Storytelling\Http\Requests\Manage\StorytellingAudio\ListRequestHandle;
use Modules\Storytelling\Http\Requests\Manage\StorytellingAudio\StoreRequestHandle;
use Modules\Storytelling\Repositories\StorytellingRepo;
use Modules\Storytelling\Services\ManageStorytellingAudioService;

class ManageStorytellingAudioController
{
    /** @var ManageStorytellingAudioService $service */
    private $service;

    /**
     * ManageStorytellingController constructor.
     */
    public function __construct()
    {
        $this->service = app(ManageStorytellingAudioService::class);
    }

    /**
     * @param ListRequestHandle $request
     * @return \Illuminate\Database\Eloquent\Collection|StorytellingAudio[]
     */
    public function index(ListRequestHandle $request)
    {
        return $this->service->list($request);
    }

    /**
     * @param ListRequestHandle $request
     * @return int
     */
    public function total(ListRequestHandle $request)
    {
        return $this->service->total($request);
    }

    /**
     * @param StoreRequestHandle $request
     * @param Cloud $cloud
     * @param StorytellingRepo $repo
     * @return \Illuminate\Database\Eloquent\Model|StorytellingAudio|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     */
    public function store(StoreRequestHandle $request, Cloud $cloud, StorytellingRepo $repo)
    {
        return $this->service->create($request, $cloud, $repo);
    }

    /**
     * @param GetIdRequestHandle $request
     * @param Cloud $cloud
     * @return StorytellingAudio|null
     * @throws \Modules\Base\Exception\ApiErrorCodeException
     * @throws \Throwable
     */
    public function delete(GetIdRequestHandle $request, Cloud $cloud)
    {
        return $this->service->delete($request, $cloud);
    }
}
