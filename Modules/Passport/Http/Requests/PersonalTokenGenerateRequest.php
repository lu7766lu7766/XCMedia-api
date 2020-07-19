<?php

namespace Modules\Passport\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class PersonalTokenGenerateRequest extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->get('description', '');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'description' => 'required|string|between:1,200'
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
        ];
    }
}
