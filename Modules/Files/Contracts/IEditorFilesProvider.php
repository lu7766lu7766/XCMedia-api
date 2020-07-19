<?php

namespace Modules\Files\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/13
 * Time: 下午 07:30
 */
interface IEditorFilesProvider
{
    /**
     * @param array $ids
     * @return Model[]|Collection
     */
    public function getByIds(array $ids);

    /**
     * @param array $ids
     * @return Model[]|Collection
     */
    public function getUnusedByIds(array $ids);

    /**
     * @param array $ids
     * @return int
     */
    public function deleteByIds(array $ids);
}
