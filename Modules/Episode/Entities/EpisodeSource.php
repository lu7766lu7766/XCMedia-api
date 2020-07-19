<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/13
 * Time: 上午 11:04
 */

namespace Modules\Episode\Entities;

use Modules\Base\Entities\BaseORM;

class EpisodeSource extends BaseORM
{
    protected $table = 'episode_source';
    protected $fillable = [
        'episode_id',
        'source_id',
        'url'
    ];
}
