<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/10
 * Time: 下午 05:41
 */

namespace Modules\Files\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Base\Util\LaravelLoggerUtil;
use Modules\Files\Contracts\IEditorFilesProvider;
use Modules\Files\Entities\EditorFiles;

class EditorFilesRepo implements IEditorFilesProvider
{
    /**
     * @param int $id
     * @return EditorFiles|Model|null
     */
    public function findUnused(int $id)
    {
        try {
            $result = EditorFiles::query()->whereDoesntHave('usingFile')->find($id);
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attributes
     * @return EditorFiles|null
     */
    public function create(array $attributes)
    {
        try {
            $result = EditorFiles::create($attributes);
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
            $result = EditorFiles::where('id', $id)->delete();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getByIds(array $ids, string $status = null)
    {
        try {
            $query = EditorFiles::whereIn('id', $ids);
            is_null($status) ? null : $query->where('status', $status);
            $result = $query->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getUnusedByIds(array $ids)
    {
        try {
            $result = EditorFiles::query()
                ->whereDoesntHave('usingFile')
                ->whereIn('id', $ids)
                ->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function deleteByIds(array $ids)
    {
        try {
            $result = EditorFiles::whereIn('id', $ids)->delete();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
