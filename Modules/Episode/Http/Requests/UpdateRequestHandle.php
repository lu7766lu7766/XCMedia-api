<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/13
 * Time: 下午 04:57
 */

namespace Modules\Episode\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class UpdateRequestHandle extends BaseFormRequest
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
     * @return string
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string
     */
    public function getOpeningTime()
    {
        return $this->get('opening_time');
    }

    /**
     * @return array
     */
    public function getSourcesUrl()
    {
        return $this->get('sources_url', []);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'episode_owner_id' => 'required|integer',
            'episode_id'       => 'required|integer',
            'title'            => 'required|string',
            'status'           => 'required|' . Rule::in(NYEnumConstants::enum()),
            'opening_time'     => 'required|date_format:Y-m-d H:i:s',
            'sources_url'      => 'sometimes|required|array',
            'sources_url.*'    => 'string',
        ];
    }
}
