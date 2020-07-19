<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/4
 * Time: 下午 01:03
 */

namespace Modules\Account\Http\Requests\Manage;

use Modules\Base\Http\Requests\AbstractLaravelRequest;

class AccountDeleteRequest extends AbstractLaravelRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->request->get('id');
    }

    /**
     * @inheritdoc
     */
    protected function rules()
    {
        return [
            'id' => 'required|integer|min:1'
        ];
    }

    /**
     * @inheritdoc
     */
    protected function messages()
    {
        return [];
    }
}
