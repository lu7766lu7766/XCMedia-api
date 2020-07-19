<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/13
 * Time: 下午 04:57
 */

namespace Modules\FAQ\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\FAQ\Entities\FAQ;

class FAQRepo
{
    /**
     * @param int $id
     * @return FAQ|null
     */
    public function find(int $id)
    {
        try {
            $result = FAQ::find($id);
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
     * @return FAQ[]|Collection
     */
    public function get(
        string $title = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = FAQ::query()->whereHas('branches')->with(['branches', 'editorFiles']);
            if (!is_null($title)) {
                $query->where('title', 'like', "%{$title}%");
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
            $query = FAQ::query()->whereHas('branches');
            if (!is_null($title)) {
                $query->where('title', 'like', "%{$title}%");
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
     * @param Collection $branches
     * @param Collection $editorFiles
     * @return FAQ|null
     */
    public function create(array $attributes, Collection $branches, Collection $editorFiles)
    {
        $result = null;
        try {
            \DB::transaction(function () use ($attributes, $branches, $editorFiles, &$result) {
                $result = FAQ::create($attributes);
                $result->publishBranches($branches);
                $result->usedEditorFile($editorFiles);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param FAQ $faq
     * @param array $attributes
     * @param Collection $branches
     * @param Collection $editorFiles
     * @return FAQ|null
     */
    public function update(FAQ $faq, array $attributes, Collection $branches, Collection $editorFiles)
    {
        $result = null;
        try {
            \DB::transaction(function () use ($faq, $attributes, $branches, $editorFiles, &$result) {
                if ($faq->update($attributes)) {
                    $faq->publishBranches($branches);
                    $faq->usedEditorFile($editorFiles);
                    $result = $faq;
                }
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param FAQ $faq
     * @return int
     */
    public function delete(FAQ $faq)
    {
        $result = 0;
        try {
            $result = FAQ::where('id', $faq->getKey())->delete();
            if ($result) {
                $faq->cancelEditorFile();
                $faq->cancelBranches();
            }
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $domain
     * @param int $page
     * @param int $perpage
     * @return Collection|FAQ[]
     */
    public function getListMorphBranch(
        string $domain,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $result = FAQ::whereHas('branches', function (Builder $query) use ($domain) {
                $query->where('domain', $domain)->where('status', NYEnumConstants::YES);
            })->where('status', NYEnumConstants::YES)->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $domain
     * @return int
     */
    public function countMorphBranch(string $domain)
    {
        try {
            $result = FAQ::whereHas('branches', function (Builder $query) use ($domain) {
                $query->where('domain', $domain)->where('status', NYEnumConstants::YES);
            })->where('status', NYEnumConstants::YES)->count();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
