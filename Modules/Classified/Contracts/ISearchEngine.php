<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 下午 06:10
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ISearchEngine
{
    /**
     * @param string $keyword
     * @param int $page
     * @param int $perpage
     * @return Collection|Model[]
     */
    public function resultsPages(string $keyword, int $page, int $perpage): Collection;

    /**
     * @param string $keyword
     * @return int
     */
    public function resultCount(string $keyword): int;
}
