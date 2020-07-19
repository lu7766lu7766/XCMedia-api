<?php

namespace Modules\Comic\Http\Requests\Manage;

use Modules\Base\Http\Requests\BaseFormRequest;

class ComicEpisodeInfoRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'id' => 'required|integer'
        ];
    }
}
