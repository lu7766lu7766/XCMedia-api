<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/15
 * Time: 下午 03:05
 */

namespace Modules\Layout\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Layout\Entities\Layout;

class LayoutRepo
{
    /**
     * @param int $id
     * @return Layout|null
     */
    public function find(int $id)
    {
        try {
            $result = Layout::find($id);
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
     * @return Layout[]|Collection
     */
    public function get(
        string $title = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Layout::query()
                ->whereHas('branches')
                ->with(['branches', 'editorFiles']);
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
            $query = Layout::query()->whereHas('branches');
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
     * @return Layout|null
     */
    public function create(array $attributes, Collection $branches, Collection $editorFiles)
    {
        $result = null;
        try {
            \DB::transaction(function () use ($attributes, $branches, $editorFiles, &$result) {
                $result = Layout::create($attributes);
                $result->publishBranches($branches);
                $result->usedEditorFile($editorFiles);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Layout $layout
     * @param array $attributes
     * @param Collection $branches
     * @param Collection $editorFiles
     * @return Layout|null
     */
    public function update(Layout $layout, array $attributes, Collection $branches, Collection $editorFiles)
    {
        $result = null;
        try {
            \DB::transaction(function () use ($layout, $attributes, $branches, $editorFiles, &$result) {
                if ($layout->update($attributes)) {
                    $layout->publishBranches($branches);
                    $layout->usedEditorFile($editorFiles);
                    $result = $layout;
                }
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Layout $layout
     * @return int
     */
    public function delete(Layout $layout)
    {
        $result = 0;
        try {
            $result = Layout::where('id', $layout->getKey())->delete();
            if ($result) {
                $layout->cancelEditorFile();
                $layout->cancelBranches();
            }
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $domain
     * @return Layout[]|Collection
     */
    public function getEnableByDomain(string $domain)
    {
        try {
            $layouts = Layout::where('status', NYEnumConstants::YES)
                ->whereHas('branches', function (Builder $query) use ($domain) {
                    $query->where('domain', $domain);
                })->get();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
            $layouts = Collection::make();
        }

        return $layouts;
    }
}
