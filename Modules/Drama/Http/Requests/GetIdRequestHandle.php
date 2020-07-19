<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/14
 * Time: 下午 05:16
 */

namespace Modules\Drama\Http\Requests;

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
