<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/13
 * Time: 上午 11:23
 */

namespace Modules\Storytelling\Http\Requests\Manage\StorytellingAudio;

use Modules\Base\Http\Requests\BaseFormRequest;

class GetIdRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getStorytellingId()
    {
        return $this->get('storytelling_id');
    }

    /**
     * @return int
     */
    public function getAudioId()
    {
        return $this->get('audio_id');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'storytelling_id' => 'required|integer',
            'audio_id'        => 'required|integer'
        ];
    }
}
