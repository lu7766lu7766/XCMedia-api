<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/15
 * Time: 下午 03:26
 */

namespace Modules\Layout\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class DeleteRequestHandle extends BaseFormRequest
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
