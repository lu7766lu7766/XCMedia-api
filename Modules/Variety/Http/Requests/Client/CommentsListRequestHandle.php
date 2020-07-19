<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/17
 * Time: 下午 02:22
 */

namespace Modules\Variety\Http\Requests\Client;

use Modules\Base\Http\Requests\BaseFormRequest;

class CommentsListRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getVarietyId()
    {
        return $this->get('variety_id');
    }

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
        return $this->get('perpage', 10);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'variety_id' => 'required|integer',
            'page'       => 'sometimes|required|integer|min:1',
            'perpage'    => 'sometimes|required|integer|between:1,100'
        ];
    }
}
