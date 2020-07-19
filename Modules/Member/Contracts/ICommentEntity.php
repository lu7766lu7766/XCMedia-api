<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/18
 * Time: 下午 02:00
 */

namespace Modules\Member\Contracts;

use Modules\Classified\Contracts\IClassifiedEntity;

interface ICommentEntity extends IClassifiedEntity
{
    /**
     * @return  \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function comments();
}
