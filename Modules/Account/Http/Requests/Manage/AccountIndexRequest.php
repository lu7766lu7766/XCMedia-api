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

/**
 * @method static getHandle($data)
 */
class AccountIndexRequest extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->get('account');
    }

    /**
     * @return int|null
     */
    public function getRoleId()
    {
        return $this->get('role_id');
    }

    /**
     * @return string
     * @see AccountStatusConstants::common()
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * @return string
     */
    public function getPerpage()
    {
        return $this->get('perpage', 20);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'account' => 'sometimes|required|string',
            'role_id' => 'sometimes|required|integer',
            'status'  => 'sometimes|required|' . Rule::in(AccountStatusConstants::common()),
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100'
        ];
    }
}
