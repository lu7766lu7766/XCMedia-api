<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/6
 * Time: 上午 09:54
 */

namespace Modules\Topic\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class GetIdRequestHandle extends BaseFormRequest
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
            'id' => 'required|integer',
        ];
    }
}
