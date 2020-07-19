<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/7
 * Time: 下午 03:00
 */

namespace Modules\Collector\Http\Requests;

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
            'id' => 'required|integer'
        ];
    }
}
