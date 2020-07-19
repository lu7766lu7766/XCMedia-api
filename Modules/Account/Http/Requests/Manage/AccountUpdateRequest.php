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

class AccountUpdateRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->get('password');
    }

    /**
     * @return string
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
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
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
            'id'           => 'required|integer',
            'password'     => 'sometimes|required|string|between:4,32|confirmed',
            'display_name' => 'required|alpha_num|between:4,32',
            'role_id'      => 'sometimes|required|array',
            'role_id.*'    => 'required|integer|min:1',
            'status'       => 'required|' . Rule::in(AccountStatusConstants::enum()),
            'remark'       => 'sometimes|required|string'
        ];
    }
}
