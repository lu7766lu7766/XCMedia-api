<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/4
 * Time: 下午 01:03
 */

namespace Modules\Account\Http\Requests\Manage;

use Illuminate\Validation\Rule;
use Modules\Account\Constants\AccountStatusConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class AccountCreateRequest extends BaseFormRequest
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
    public function getPassword()
    {
        return $this->get('password');
    }

    /**
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->get('display_name');
    }

    /**
     * @return array
     */
    public function getRoleIds()
    {
        return $this->get('role_id');
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status', AccountStatusConstants::ENABLE);
    }

    /**
     * @return string|null
     */
    public function getRemark()
    {
        return $this->get('remark');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'account'      => 'required|string|alpha_num|between:4,32|unique:account,account',
            'password'     => 'required|string|between:4,32|confirmed',
            'display_name' => 'required|alpha_num|between:4,32',
            'role_id'      => 'required|array',
            'role_id.*'    => 'required|integer|min:1',
            'status'       => 'sometimes|required|' . Rule::in(AccountStatusConstants::enum()),
            'remark'       => 'sometimes|required|string',
        ];
    }
}
