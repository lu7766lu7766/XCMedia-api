<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/6
 * Time: 上午 11:18
 */

namespace Modules\Member\Http\Requests\Manage;

use Modules\Base\Http\Requests\BaseFormRequest;

class MemberLoginHistoryRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
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
            'id'      => 'required|integer',
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100'
        ];
    }
}
