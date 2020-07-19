<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/5
 * Time: 下午 03:50
 */

namespace Modules\Member\Http\Requests\Manage;

use Modules\Base\Http\Requests\BaseFormRequest;

class MemberProfileRequest extends BaseFormRequest
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
