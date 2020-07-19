<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/18
 * Time: 下午 03:50
 */

namespace Modules\Member\Http\Requests\Client\Profile;

use Modules\Base\Http\Requests\BaseFormRequest;

class UpdatePasswordRequest extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getOldPassword()
    {
        return $this->get('old_password');
    }

    /**
     * @return string
     */
    public function getNewPassword()
    {
        return $this->get('password');
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
            'old_password' => 'required|string',
            'password'     => 'required|string|confirmed|min:4|max:16|alpha_dash'
        ];
    }
}
