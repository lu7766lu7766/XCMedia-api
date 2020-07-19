<?php

namespace Modules\Role\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class PublicRoleNodeMapRequest extends BaseFormRequest
{
    /**
     * Role id
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
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
            'id' => 'required|integer|min:1'
        ];
    }
}
