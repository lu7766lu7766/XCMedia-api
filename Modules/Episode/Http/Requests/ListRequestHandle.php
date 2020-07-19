<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/12
 * Time: 下午 05:23
 */

namespace Modules\Episode\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class ListRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getEpisodeOwnerId()
    {
        return $this->get('episode_owner_id');
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'episode_owner_id' => 'required|integer',
            'page'             => 'sometimes|required|integer|min:1',
            'perpage'          => 'sometimes|required|integer|between:1,100'
        ];
    }
}
