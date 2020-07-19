<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/2
 * Time: 下午 06:16
 */

namespace Modules\Branch\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class StoreRequestHandle extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->get('code');
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->get('domain');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string
     */
    public function isRegister()
    {
        return $this->get('is_register');
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
            'name'        => 'required|string|max:30',
            'code'        => 'required|string|max:30|' . Rule::unique('branch'),
            'domain'      => 'required|string|max:255|' . Rule::unique('branch'),
            'status'      => 'required|' . Rule::in(NYEnumConstants::enum()),
            'is_register' => 'required|' . Rule::in(NYEnumConstants::enum()),
            'remark'      => 'sometimes|required|string',
        ];
    }
}
