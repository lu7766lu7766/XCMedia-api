<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/7
 * Time: 下午 05:30
 */

namespace Modules\Announcement\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class EditRequestHandle extends BaseFormRequest
{
    /**
     * @return integer
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
