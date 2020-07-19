<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/15
 * Time: 下午 02:22
 */

namespace Modules\Member\Http\Requests\Client;

use Modules\Base\Http\Requests\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->get('account');
    }

    /**
     * @return string
     */
    public function getMemberPassword()
    {
        return $this->get('password');
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->get('domain');
    }

    /**
     * @return string|null
     */
    public function getVerificationCode()
    {
        return $this->get('verification_code');
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
            'account'           => 'required|string|regex:/^1([0-9]{10})$/',
            'password'          => 'required|string|confirmed',
            'domain'            => 'required|string',
            'verification_code' => 'sometimes|required|string',
        ];
    }
}
