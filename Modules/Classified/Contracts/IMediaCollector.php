<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/4/14
 * Time: 下午 03:15
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IMediaCollector
{
    /**
     * @param array $title
     * @return Model[]|Collection
     */
    public function whereInByTitle(array $title);

    /**
     * @param array $attributes
     * @return Model|null
     */
    public function create(array $attributes);
}
