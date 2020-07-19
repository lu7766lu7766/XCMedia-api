<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/19
 * Time: 下午 05:12
 */

namespace Modules\FAQ\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class ClientListRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * @return int
     */
    public function getPerpage()
    {
        return $this->get('perpage', 20);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100'
        ];
    }
}
