<?php

namespace Modules\Movie\Http\Requests\Manage;

use Modules\Base\Http\Requests\BaseFormRequest;

class MovieInfoRequest extends BaseFormRequest
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
