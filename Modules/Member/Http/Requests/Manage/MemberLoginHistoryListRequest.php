<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/6
 * Time: 上午 11:18
 */

namespace Modules\Member\Http\Requests\Manage;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Member\Constants\MemberStatusConstants;

class MemberLoginHistoryListRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getBranchId()
    {
        return $this->get('branch_id');
    }

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
    public function getStart()
    {
        return $this->get('start');
    }

    /**
     * @return string
     */
    public function getEnd()
    {
        return $this->get('end');
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * @return int
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
            'branch_id' => 'sometimes|required|integer',
            'account'   => 'sometimes|string|alpha_num',
            'status'    => 'sometimes|required|' . Rule::in(MemberStatusConstants::common()),
            'start'     => 'required_with:end|date_format:Y-m-d H:i:s',
            'end'       => 'required_with:start|date_format:Y-m-d H:i:s|after:start',
            'page'      => 'sometimes|required|integer|min:1',
            'perpage'   => 'sometimes|required|integer|between:1,100'
        ];
    }
}
