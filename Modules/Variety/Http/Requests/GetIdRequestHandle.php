<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/17
 * Time: 下午 06:07
 */

namespace Modules\Variety\Http\Requests;

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
