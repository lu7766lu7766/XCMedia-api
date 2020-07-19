<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/6
 * Time: 下午 06:43
 */

namespace Modules\Announcement\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Announcement\Entities\Announcement;
use Modules\Base\Util\LaravelLoggerUtil;

class AnnouncementRepo
{
    /**
     * @param string|null $title
     * @param string|null $marqueeSwitch
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @return Announcement[]|Collection
     */
    public function get(
        string $title = null,
        string $marqueeSwitch = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Announcement::query()->whereHas('branches')->with(['branches', 'editorFiles']);
            if (!is_null($title)) {
                $query->where('title', 'like', "%{$title}%");
            }
            if (!is_null($marqueeSwitch)) {
                $query->where('marquee_switch', $marqueeSwitch);
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
     * @param string|null $marqueeSwitch
     * @param string|null $status
     * @return int
     */
    public function count(
        string $title = null,
        string $marqueeSwitch = null,
        string $status = null
    ) {
        try {
            $query = Announcement::query()->whereHas('branches');
            if (!is_null($title)) {
                $query->where('title', 'like', "%{$title}%");
            }
            if (!is_null($marqueeSwitch)) {
                $query->where('marquee_switch', $marqueeSwitch);
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
     * @param int $id
     * @return Announcement|null
     */
    public function find(int $id)
    {
        try {
            $result = Announcement::find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @param Collection $branches
     * @param Collection $editorFiles
     * @return Announcement|null
     */
    public function create(array $attributes, Collection $branches, Collection $editorFiles)
    {
        $result = null;
        try {
            \DB::transaction(function () use ($attributes, $branches, $editorFiles, &$result) {
                $result = Announcement::create($attributes);
                $result->publishBranches($branches);
                $result->usedEditorFile($editorFiles);
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Announcement $announcement
     * @param array $attributes
     * @param Collection $branches
     * @param Collection $editorFiles
     * @return Announcement|null
     */
    public function update(
        Announcement $announcement,
        array $attributes,
        Collection $branches,
        Collection $editorFiles
    ) {
        $result = null;
        try {
            \DB::transaction(function () use ($announcement, $attributes, $branches, $editorFiles, &$result) {
                if ($announcement->update($attributes)) {
                    $announcement->publishBranches($branches);
                    $announcement->usedEditorFile($editorFiles);
                    $result = $announcement;
                }
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Announcement $announcement
     * @return int
     */
    public function delete(Announcement $announcement)
    {
        $result = 0;
        try {
            \DB::transaction(function () use ($announcement, &$result) {
                if ($result = Announcement::where('id', $announcement->getKey())->delete()) {
                    $announcement->cancelEditorFile();
                    $announcement->cancelBranches();
                }
            });
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
