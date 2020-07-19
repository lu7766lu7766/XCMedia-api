<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/4/13
 * Time: 下午 01:57
 */

namespace Modules\Classified\Collector;

use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use MediaCollector\Client;
use MediaCollector\Constants\MediaTypeConstants;
use MediaCollector\Constants\PlatformConstants;
use MediaCollector\MediaList;
use Modules\Anime\Entities\Anime;
use Modules\Anime\Repositories\AnimeCollectorRepo;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Classified\Constants\ClassifiedConstant;
use Modules\Classified\Contracts\IMediaCollector;
use Modules\Classified\Entities\Genres;
use Modules\Classified\Entities\Region;
use Modules\Classified\Entities\Years;
use Modules\Classified\Repositories\GenresSettingRepo;
use Modules\Classified\Repositories\RegionRepo;
use Modules\Classified\Repositories\SourceSettingRepo;
use Modules\Classified\Repositories\YearsSettingRepo;
use Modules\Drama\Entities\Drama;
use Modules\Drama\Repositories\DramaCollectorRepo;
use Modules\Episode\Constants\EpisodeStatusConstants;
use Modules\Episode\Repositories\EpisodeSourceRepo;
use Modules\Episode\Repositories\OwnerEpisodeRepo;
use Modules\Movie\Entities\Movie;
use Modules\Movie\Repositories\MovieCollectorRepo;
use Modules\Variety\Entities\Variety;
use Modules\Variety\Repositories\VarietyCollectorRepo;
use Ramsey\Uuid\Uuid;
use XC\Independent\Kit\Network\Curl\Curl;

class MediaCollector
{
    /** @var Client $client */
    private $client;
    /** @var Cloud $cloud */
    private $cloud;

    /**
     * MediaCollector constructor.
     * @param Cloud $cloud
     */
    public function __construct(Cloud $cloud)
    {
        $this->client = new Client(config('Classified.config.media_api_url'));
        $this->cloud = $cloud;
    }

    /**
     * @param string $mediaType
     * @param string|null $date
     */
    public function run(string $mediaType, string $date = null)
    {
        foreach (PlatformConstants::enum() as $platformId) {
            $media = $this->eachPage($platformId, $mediaType, $date);
            $this->processData($mediaType, $media, $platformId);
        }
    }

    /**
     * @param string $mediaType
     * @return string
     */
    private function mapMediaType(string $mediaType)
    {
        $list = [
            'movie'   => MediaTypeConstants::MOVIE,
            'drama'   => MediaTypeConstants::DRAMA,
            'variety' => MediaTypeConstants::VARIETY,
            'anime'   => MediaTypeConstants::ANIME,
        ];

        return $list[$mediaType];
    }

    /**
     * @param string $mediaType
     * @return IMediaCollector
     */
    private function repoFactory(string $mediaType)
    {
        $repos = [
            'movie'   => new MovieCollectorRepo(),
            'drama'   => new DramaCollectorRepo(),
            'variety' => new VarietyCollectorRepo(),
            'anime'   => new AnimeCollectorRepo(),
        ];

        return $repos[$mediaType];
    }

    /**
     * @param int $sourceId
     * @return string
     */
    private function mapSource(int $sourceId)
    {
        $sources = [
            PlatformConstants::IQIYI => '爱奇艺',
            PlatformConstants::QQ    => '腾讯',
            PlatformConstants::SOHU  => '搜狐',
            PlatformConstants::MANGO => '芒果',
            PlatformConstants::YOUKU => '优酷',
        ];

        return $sources[$sourceId];
    }

    /**
     * @param string $mediaType
     * @return string
     */
    private function mapCoverPath(string $mediaType)
    {
        $path = [
            'movie'   => config('Movie.config.movie_path'),
            'drama'   => config('Drama.config.file_path'),
            'variety' => config('Variety.config.file_path'),
            'anime'   => config('Anime.config.file_path'),
        ];

        return $path[$mediaType];
    }

    /**
     * @param int $statusCode
     * @return string
     */
    private function mapEpisodeStatus(int $statusCode)
    {
        $status = EpisodeStatusConstants::enum();

        return $status[$statusCode];
    }

    /**
     * @param int $platformId
     * @param string $mediaType
     * @param null $date
     * @param int $page
     * @param array $result
     * @return Collection
     */
    private function eachPage(int $platformId, string $mediaType, $date = null, $page = 1, array $result = [])
    {
        $response = $this->client->getMedia($platformId, $this->mapMediaType($mediaType), $date, $page);
        if (!$response->isErrorOccur()) {
            $isNextPage = true;
            $media = $response->getMediaList(function (MediaList $list) {
                return $list->all();
            });
            if (empty($media)) {
                $isNextPage = false;
            }
            $result = array_merge($result, $media);
            if ($isNextPage) {
                $result = $this->eachPage($platformId, $mediaType, $date, $page + 1, $result);
            }
        }

        return collect($result);
    }

    /**
     * @param string $mediaType
     * @param Collection $media
     * @param int $platformId
     */
    private function processData(string $mediaType, Collection $media, int $platformId)
    {
        $mediaRepo = $this->repoFactory($mediaType);
        $exist = $this->exist($media, $mediaRepo);
        $notExist = $media->whereNotIn('title', $exist->pluck('title'));
        if ($notExist->isNotEmpty()) {
            $sourceRepo = app(SourceSettingRepo::class, ['type' => $mediaType]);
            $sourceOrm = $sourceRepo->firstOrCreateByTitle($this->mapSource($platformId));
            $episodeRepo = app(OwnerEpisodeRepo::class);
            $episodeSourceRepo = app(EpisodeSourceRepo::class);
            $timeNow = Carbon::now();
            $data = $this->processRegion($mediaType, $notExist);
            $data = $this->processYear($mediaType, $data);
            $data = $this->processCover($mediaType, $data);
            $data = $this->processGenres($mediaType, $data);
            $data->map(function ($item) use (
                $mediaType,
                $sourceOrm,
                $mediaRepo,
                $episodeRepo,
                $episodeSourceRepo,
                $timeNow
            ) {
                $attributes = [
                    'image_path'     => $item['image_path'],
                    'episode_status' => $this->mapEpisodeStatus($item['end']),
                    'status'         => NYEnumConstants::YES,
                    'region_id'      => $item['region_id'],
                    'years_id'       => $item['years_id'],
                    'description'    => $item['description'],
                    'updated_at'     => $item['updatetime'],
                    'created_at'     => $item['addtime'],
                ];
                $mediaType == ClassifiedConstant::MOVIE ?
                    $attributes['name'] = $item['title'] :
                    $attributes['title'] = $item['title'];
                $mediaType == ClassifiedConstant::VARIETY ?
                    $attributes['host'] = $item['actors'] :
                    $attributes['starring'] = $item['actors'];
                $orm = $mediaRepo->create($attributes);
                /** @var Drama|Variety|Anime|Movie $orm */
                $orm->genres()->sync([$item['type']]);
                foreach ($item['url'] as $key => $url) {
                    $episode = $episodeRepo->create($orm, [
                        'title'        => 'EP' . ($key + 1),
                        'opening_time' => $timeNow,
                        'status'       => NYEnumConstants::YES
                    ]);
                    $episodeSourceRepo->create(
                        [
                            'episode_id' => $episode->getKey(),
                            'source_id'  => $sourceOrm->getKey(),
                            'url'        => $url,
                        ]
                    );
                }
            });
        }
    }

    /**
     * @param string $mediaType
     * @param Collection $data
     * @return Collection
     */
    private function processRegion(string $mediaType, Collection $data)
    {
        $repo = app(RegionRepo::class);
        //將撈回的影音列表資料去除重複整理成地區
        $region = $data->map(function ($item) {
            return [
                'name' => $item['area']
            ];
        })->unique();
        //丟進資料庫裡找存在的資料
        $exist = $repo->whereInByName($mediaType, $region->pluck('name')->toArray());
        //地區與存在的資料做叉集比對後新增
        $attribute = $region->whereNotIn('name', $exist->pluck('name'))
            ->map(function ($item) use ($mediaType) {
                $time = Carbon::now();

                return [
                    'name'       => $item['name'],
                    'status'     => NYEnumConstants::YES,
                    'used_type'  => $mediaType,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];
            });
        $repo->insert($attribute->toArray());

        //將新增的地區id塞回影音列表內
        return $repo->whereInByName($mediaType, $region->pluck('name')->toArray())
            ->map(function (Region $region) use ($data) {
                return $data->where('area', $region->getAttribute('name'))->map(function ($item) use ($region) {
                    $item['region_id'] = $region->getKey();
                    unset($item['area']);

                    return $item;
                });
            })->collapse();
    }

    /**
     * @param string $mediaType
     * @param Collection $data
     * @return Collection
     */
    private function processYear(string $mediaType, Collection $data)
    {
        $repo = app(YearsSettingRepo::class);
        $year = $data->map(function ($item) {
            return [
                'title' => $item['years']
            ];
        })->unique();
        $exist = $repo->whereInByTitle($mediaType, $year->pluck('title')->toArray());
        $attribute = $year->whereNotIn('title', $exist->pluck('title'))
            ->map(function ($item) use ($mediaType) {
                $time = Carbon::now();

                return [
                    'title'      => $item['title'],
                    'status'     => NYEnumConstants::YES,
                    'used_type'  => $mediaType,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];
            });
        $repo->insert($attribute->toArray());

        return $repo->whereInByTitle($mediaType, $year->pluck('title')->toArray())
            ->map(function (Years $years) use ($data) {
                return $data->where('years', $years->getAttribute('title'))->map(function ($item) use ($years) {
                    $item['years_id'] = $years->getKey();
                    unset($item['years']);

                    return $item;
                });
            })->collapse();
    }

    /**
     * @param string $mediaType
     * @param Collection $data
     * @return Collection|Genres[]
     */
    private function processGenres(string $mediaType, Collection $data)
    {
        $repo = app(GenresSettingRepo::class);
        $genres = $data->map(function ($item) {
            return [
                'title' => $item['type']
            ];
        })->unique();
        $exist = $repo->whereInByTitle($mediaType, $genres->pluck('title')->toArray());
        $attribute = $genres->whereNotIn('title', $exist->pluck('title'))
            ->map(function ($item) use ($mediaType) {
                $time = Carbon::now();

                return [
                    'title'      => $item['title'],
                    'status'     => NYEnumConstants::YES,
                    'used_type'  => $mediaType,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];
            });
        $repo->insert($attribute->toArray());

        return $repo->whereInByTitle($mediaType, $genres->pluck('title')->toArray())
            ->map(function (Genres $genres) use ($data) {
                return $data->where('type', $genres->getAttribute('title'))->map(function ($item) use ($genres) {
                    $item['type'] = $genres->getKey();

                    return $item;
                });
            })->collapse();
    }

    /**
     * @param string $mediaType
     * @param Collection $data
     * @return Collection
     */
    private function processCover(string $mediaType, Collection $data)
    {
        $path = $this->mapCoverPath($mediaType);
        $data = $data->map(function ($item) use ($path) {
            $image = $item['cover'];
            if (strpos($item['cover'], 'http') === false) {
                $image = 'http:' . $item['cover'];
            }
            $imageInfo = app(Curl::class)->get($image);
            $imageName = Uuid::uuid4()->toString();
            if ($this->cloud->put(
                $path . DIRECTORY_SEPARATOR . $imageName,
                $imageInfo->body(),
                Filesystem::VISIBILITY_PUBLIC
            )) {
                $item['image_path'] = $path . DIRECTORY_SEPARATOR . $imageName;
                unset($item['cover']);
            }

            return $item;
        });

        return $data;
    }

    /**
     * @param Collection $media
     * @param IMediaCollector $mediaRepo
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    private function exist(Collection $media, IMediaCollector $mediaRepo)
    {
        $today = Carbon::today();
        $exist = $mediaRepo->whereInByTitle($media->pluck('title')->toArray());
        $filterData = $exist->where('updated_at', '<', $today);
        if ($filterData->isNotEmpty()) {
            $filterData->map(function (Model $orm) {
                \DB::transaction(function () use ($orm) {
                    /** @var Drama|Variety|Anime|Movie $orm */
                    $orm->delete();
                    $this->cloud->delete($orm->getAttribute('image_path'));
                    $orm->episodes()->delete();
                });
            });
        }

        return $exist->whereNotIn('id', $filterData->pluck('id')->toArray());
    }
}
