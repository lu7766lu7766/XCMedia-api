<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 上午 11:04
 */

namespace Modules\Classified\Http\Requests\Cup;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class CupUpdateRequest extends BaseFormRequest
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
    public function getSize()
    {
        return $this->get('size');
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
    public function getNote()
    {
        return $this->get('note');
    }

    /**
     * Request args validate rules.
     * @link https://laravel.com/docs/master/validation lookup link and know how to write rule.
     * @return array
     * @see https://laravel.com/docs/master/validation#available-validation-rules
     * checkout this to get more rule keyword info
     */
    public function rules()
    {
        return [
            'id'     => 'required|integer',
            'size'   => 'required|string|max:20',
            'status' => 'required|' . Rule::in(NYEnumConstants::enum()),
            'note'   => 'sometimes|required|string|max:255'
        ];
    }
}
