<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/12
 * Time: 下午 04:49
 */

namespace Modules\Storytelling\Entities;

use Modules\Base\Entities\BaseORM;

/**
 * Class StorytellingAudio
 * @package Modules\Storytelling\Entities
 * @property string original_file_name
 * @property string file_path
 * @property string file_url
 */
class StorytellingAudio extends BaseORM
{
    /** @internal */
    protected $table = 'storytelling_audio';
    /** @internal */
    protected $fillable = [
        'original_file_name',
        'file_path',
        'file_url'
    ];

    public function storytelling()
    {
        return $this->belongsTo(Storytelling::class, 'storytelling_id');
    }
}
