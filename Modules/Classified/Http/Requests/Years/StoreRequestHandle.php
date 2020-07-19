<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/17
 * Time: 下午 04:43
 */

namespace Modules\Classified\Http\Requests\Years;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class StoreRequestHandle extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string|null
     */
    public function getRemark()
    {
        return $this->get('remark');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'title'  => 'required|string',
            'status' => 'required|' . Rule::in(NYEnumConstants::enum()),
            'remark' => 'sometimes|required|string'
        ];
    }
}
