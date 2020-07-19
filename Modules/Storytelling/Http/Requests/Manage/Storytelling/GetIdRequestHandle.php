<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/12
 * Time: 上午 11:00
 */

namespace Modules\Storytelling\Http\Requests\Manage\Storytelling;

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
