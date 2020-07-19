<?php

namespace Modules\Comic\Http\Requests\Manage;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class ComicEpisodeEditRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getComicId()
    {
        return $this->get('comic_id');
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
    public function getImageIds()
    {
        return $this->get('image_ids', []);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'comic_id'     => 'required|integer',
            'title'        => 'required|string',
            'status'       => 'required|' . Rule::in(NYEnumConstants::enum()),
            'opening_time' => 'required|date_format:Y-m-d H:i:s',
            'image_ids'    => 'sometimes|required|array',
            'image_ids.*'  => 'integer',
        ];
    }
}
