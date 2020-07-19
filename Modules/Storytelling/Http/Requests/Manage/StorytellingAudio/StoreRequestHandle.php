<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/12
 * Time: 下午 04:56
 */

namespace Modules\Storytelling\Http\Requests\Manage\StorytellingAudio;

use Modules\Base\Http\Requests\BaseFormRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StoreRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getStorytellingId()
    {
        return $this->get('storytelling_id');
    }

    /**
     * @return UploadedFile|null
     */
    public function getAudio()
    {
        return $this->file('audio');
    }

    /**
     * Request args validate rules.
     * @link https://laravel.com/docs/master/validation lookup link and know how to write rule.
     * @return array
     * @see https://laravel.com/docs/master/validation#available-validation-rules
     * checkout this to get more rule keyword info
     */
    public function rules()
    {
        return [
            'storytelling_id' => 'required|integer',
            'audio'           => 'required|file|mimes:audio/mpeg,mpga,mp3,wav,aac'
        ];
    }
}
