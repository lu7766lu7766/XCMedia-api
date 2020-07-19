<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/16
 * Time: 下午 06:14
 */

namespace Modules\Drama\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class GetCommentRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getMediaId()
    {
        return $this->get('media_id');
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
        return $this->get('perpage', 20);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'media_id' => 'required|integer',
            'page'     => 'sometimes|required|integer|min:1',
            'perpage'  => 'sometimes|required|integer|between:1,100'
        ];
    }
}
