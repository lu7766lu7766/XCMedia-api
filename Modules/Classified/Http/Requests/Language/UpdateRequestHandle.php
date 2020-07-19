<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/3
 * Time: 下午 07:28
 */

namespace Modules\Classified\Http\Requests\Language;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class UpdateRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

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
            'id'     => 'required|integer',
            'title'  => 'required|string',
            'status' => 'required|' . Rule::in(NYEnumConstants::enum()),
            'remark' => 'sometimes|required|string'
        ];
    }
}
