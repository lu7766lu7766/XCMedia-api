<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/16
 * Time: 下午 03:32
 */

namespace Modules\Variety\Http\Requests\Client;

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
