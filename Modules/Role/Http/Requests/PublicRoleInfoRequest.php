<?php

namespace Modules\Role\Http\Requests;

use Modules\Base\Http\Requests\AbstractLaravelRequest;

class PublicRoleInfoRequest extends AbstractLaravelRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->request->get('id');
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

    /**
     * Request args validate msg on fail.
     * @link https://laravel.com/docs/master/validation lookup link and know how to write message.
     * @return array
     * @see https://laravel.com/docs/master/validation#customizing-the-error-messages
     * checkout this to get more message info
     * @see https://laravel.com/docs/master/validation#working-with-error-messages
     * checkout this to get more message info
     */
    public function messages()
    {
        return [];
    }
}
