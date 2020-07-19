<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/1/30
 * Time: 下午 06:43
 */

namespace Modules\Classified\Http\Requests\Genres;

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
