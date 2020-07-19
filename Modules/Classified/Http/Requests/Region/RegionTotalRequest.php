<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/3
 * Time: 上午 11:10
 */

namespace Modules\Classified\Http\Requests\Region;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class RegionTotalRequest extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->get('name');
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
            'name'   => 'sometimes|required|string|max:20',
            'status' => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
        ];
    }
}
