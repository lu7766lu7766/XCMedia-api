<?php

namespace Modules\Role\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class PublicRoleListRequest extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getEnable()
    {
        return $this->get('enable');
    }

    /**
     * 頁數
     * @return int
     */
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * 筆數
     * @return int
     */
    public function getPerpage()
    {
        return $this->get('perpage', 20);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'enable'  => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100',
        ];
    }
}
