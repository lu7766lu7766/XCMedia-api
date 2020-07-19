<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 01:46
 */

namespace Modules\Classified\Http\Requests\AVActress;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class AVActressTotalRequest extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getKeyword()
    {
        return $this->get('keyword');
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
            'keyword' => 'sometimes|required|string|max:20',
            'status'  => 'sometimes|required|' . Rule::in(NYEnumConstants::enum())
        ];
    }
}
