<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/3/16
 * Time: 下午 06:39
 */

namespace Modules\Movie\Http\Requests\Client;

use Modules\Base\Http\Requests\BaseFormRequest;

class MovieCommentsListRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
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
            'id'      => 'required|integer',
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100'
        ];
    }
}
