<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/3
 * Time: 下午 07:27
 */

namespace Modules\Classified\Http\Requests\Language;

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
