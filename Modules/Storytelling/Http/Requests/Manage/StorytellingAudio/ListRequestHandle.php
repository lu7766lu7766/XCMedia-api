<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/13
 * Time: 上午 11:08
 */

namespace Modules\Storytelling\Http\Requests\Manage\StorytellingAudio;

use Modules\Base\Http\Requests\BaseFormRequest;

class ListRequestHandle extends BaseFormRequest
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
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * @return int
     */
    public function getPerpage()
    {
        return $this->get('perpage', 20);
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
            'storytelling_id' => 'required|int',
            'page'            => 'sometimes|required|integer|min:1',
            'perpage'         => 'sometimes|required|integer|between:1,100'
        ];
    }
}
