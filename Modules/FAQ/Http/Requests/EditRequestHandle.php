<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/13
 * Time: 下午 06:24
 */

namespace Modules\FAQ\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class EditRequestHandle extends BaseFormRequest
{
    /**
     * @return integer
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
