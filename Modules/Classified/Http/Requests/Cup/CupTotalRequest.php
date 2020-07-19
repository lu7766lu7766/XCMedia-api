<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 上午 11:03
 */

namespace Modules\Classified\Http\Requests\Cup;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class CupTotalRequest extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getSize()
    {
        return $this->get('size');
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
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
            'size'   => 'sometimes|required|string|max:20',
            'status' => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
        ];
    }
}
