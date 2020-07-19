<?php

namespace Modules\Role\Http\Requests;

use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class CustomRoleCreateRequest extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->get('description');
    }

    /**
     * @return string
     */
    public function getEnable()
    {
        return $this->get('enable', NYEnumConstants::YES);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|between:1,16',
            'description' => 'sometimes|string',
            'enable'      => 'sometimes|required|in:' . NYEnumConstants::implodeEnum(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [];
    }
}
