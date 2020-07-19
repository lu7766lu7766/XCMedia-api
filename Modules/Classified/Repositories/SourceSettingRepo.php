<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/30
 * Time: 下午 03:34
 */

namespace Modules\Classified\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Classified\Contracts\ISourceProvider;
use Modules\Classified\Entities\Source;

class SourceSettingRepo implements ISourceProvider
{
    /** @var string $usedType */
    private $usedType;

    /**
     * SourceSettingRepo constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->usedType = $type;
    }

    /**
     * @return Source|Collection
     */
    public function getAllByUsedType()
    {
        try {
            $result = Source::where('used_type', $this->usedType)
                ->where('status', NYEnumConstants::YES)
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = Collection::make();
        }

        return $result;
    }

    /**
     * @param int $id
     * @param string|null $status
     * @return Source|null
     */
    public function find(int $id, string $status = null)
    {
        try {
            $builder = Source::where('used_type', $this->usedType);
            if (!is_null($status)) {
                $builder->where('status', $status);
            }
            $result = $builder->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $title
     * @return Source|null
     */
    public function firstOrCreateByTitle(string $title)
    {
        try {
            $result = Source::where('used_type', $this->usedType)
                ->firstOrCreate(
                    [
                        'title' => $title
                    ],
                    [
                        'title'     => $title,
                        'status'    => NYEnumConstants::YES,
                        'used_type' => $this->usedType,
                    ]
                );
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $title
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @return Source[]|Collection
     */
    public function get(
        string $title = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Source::where('used_type', $this->usedType);
            if (!is_null($title)) {
                $query->where('title', 'like', '%' . $title . '%');
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $title
     * @param string|null $status
     * @return int
     */
    public function count(string $title = null, string $status = null)
    {
        try {
            $query = Source::where('used_type', $this->usedType);
            if (!is_null($title)) {
                $query->where('title', 'like', '%' . $title . '%');
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @return Source|null
     */
    public function create(array $attributes)
    {
        try {
            $attributes['used_type'] = $this->usedType;
            $result = Source::create($attributes);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Source $source
     * @param array $attributes
     * @return Source|null
     */
    public function update(Source $source, array $attributes)
    {
        try {
            $source->update($attributes);
            $result = $source;
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        try {
            $result = Source::where('used_type', $this->usedType)->where('id', $id)->delete();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $ids
     * @return Source[]|Collection
     */
    public function getByIds(array $ids)
    {
        try {
            $result = Source::whereIn('id', $ids)->where('used_type', $this->usedType)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $mediaTYpe
     * @param int $mediaId
     * @return Source[]|Collection
     */
    public function getEnableOnlineByMedia(string $mediaTYpe, int $mediaId)
    {
        try {
            $sources = Source::where('status', NYEnumConstants::YES)
                ->where('used_type', $this->usedType)
                ->whereHas('quote', function (Builder $query) use ($mediaTYpe, $mediaId) {
                    $query->whereNotNull('url')
                        ->where('opening_time', '<=', Carbon::now())
                        ->where('status', NYEnumConstants::YES)
                        ->whereHasMorph('series', $mediaTYpe, function (Builder $query) use ($mediaId) {
                            $query->whereKey($mediaId);
                        });
                })->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $sources = Collection::make();
        }

        return $sources;
    }

    /**
     * @param int $id
     * @return Source[]|Collection
     */
    public function getAllByUsedTypeWithEpisode(int $id)
    {
        try {
            $result = Source::where('used_type', $this->usedType)
                ->where('status', NYEnumConstants::YES)
                ->wherehas('episode')
                ->with([
                    'episode' => function (Relation $query) use ($id) {
                        $query->where('media_id', $id)
                            ->where('episode.status', NYEnumConstants::YES)
                            ->where('opening_time', '<=', Carbon::now()->toDateTimeString());
                    }
                ])
                ->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $result = Collection::make();
        }

        return $result;
    }
}
