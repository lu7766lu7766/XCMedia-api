<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/6
 * Time: 上午 11:18
 */

namespace Modules\Member\Http\Requests\Manage;

use Modules\Base\Http\Requests\BaseFormRequest;

class MemberLoginHistoryInfoRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'id' => 'required|integer'
        ];
    }
}
