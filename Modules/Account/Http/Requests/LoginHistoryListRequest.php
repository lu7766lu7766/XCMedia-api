<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/7/1
 * Time: 下午 05:03
 */

namespace Modules\Account\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class LoginHistoryListRequest extends BaseFormRequest
{
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
     * @return int|null
     */
    public function getRoleId()
    {
        return $this->get('role_id', null);
    }

    /**
     * @return string|null
     */
    public function getKeyword()
    {
        return $this->get('keyword', null);
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * @return int|null
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
            'start'   => 'required|date_format:Y-m-d H:i:s',
            'end'     => 'required|date_format:Y-m-d H:i:s|after:start',
            'role_id' => 'sometimes|required|integer|min:1',
            'keyword' => 'sometimes|required|string',
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100',
        ];
    }
}
