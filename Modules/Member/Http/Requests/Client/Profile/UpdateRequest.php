<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/18
 * Time: 下午 03:35
 */

namespace Modules\Member\Http\Requests\Client\Profile;

use Modules\Base\Http\Requests\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->get('email');
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->get('phone');
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
            'email' => 'sometimes|required|string|email',
            'phone' => 'sometimes|required|numeric',
        ];
    }
}
