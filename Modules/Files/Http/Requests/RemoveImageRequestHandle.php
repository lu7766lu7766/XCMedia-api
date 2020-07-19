<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/10
 * Time: 下午 06:12
 */

namespace Modules\Files\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class RemoveImageRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getImageId()
    {
        return $this->get('image_id');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'image_id' => 'required|int',
        ];
    }
}
