<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/12
 * Time: 下午 03:12
 */

namespace Modules\Episode\Contracts\Entire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Base\Entities\BaseORM;

/**
 * Interface IEpisode
 * @package Modules\Episode\Contracts\Entire
 * @property Model|null series
 * @mixin BaseORM
 */
interface IEpisode
{
    /**
     * @return MorphTo
     */
    public function series(): MorphTo;
}
