<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/14
 * Time: 下午 04:47
 */

namespace Modules\Anime\Http\Requests;

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
