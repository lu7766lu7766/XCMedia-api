<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/4/28
 * Time: 下午 06:23
 */

namespace Modules\Member\Http\Requests\Client;

use Modules\Base\Http\Requests\BaseFormRequest;

class SendVerificationCodeRequestHandle extends BaseFormRequest
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
    public function getDomain()
    {
        return $this->get('domain');
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
            'account' => 'required|string|regex:/^1([0-9]{10})$/',
            'domain'  => 'required|string',
        ];
    }
}
