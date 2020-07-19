<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/13
 * Time: 下午 07:13
 */

namespace Modules\Episode\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class GetEpisodeIdRequestHandle extends BaseFormRequest
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
    public function getEpisodeId()
    {
        return $this->get('episode_id');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'episode_owner_id' => 'required|integer',
            'episode_id'       => 'required|integer',
        ];
    }
}
