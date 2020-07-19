<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/17
 * Time: 下午 05:06
 */

namespace Modules\Classified\Http\Requests\Source;

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
