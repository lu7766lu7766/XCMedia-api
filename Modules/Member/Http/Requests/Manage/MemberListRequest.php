<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/5
 * Time: 下午 03:50
 */

namespace Modules\Member\Http\Requests\Manage;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Member\Constants\MemberStatusConstants;

class MemberListRequest extends BaseFormRequest
{
    /**
     * @return int|null
     */
    public function getBranchId()
    {
        return $this->get('branch_id');
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string|null
     * @see MemberStatusConstants::common()
     */
    public function getKeyword()
    {
        return $this->get('keyword');
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
            'status'    => 'sometimes|required|' . Rule::in(MemberStatusConstants::common()),
            'keyword'   => 'sometimes|required|string',
            'page'      => 'sometimes|required|integer|min:1',
            'perpage'   => 'sometimes|required|integer|between:1,100'
        ];
    }
}
