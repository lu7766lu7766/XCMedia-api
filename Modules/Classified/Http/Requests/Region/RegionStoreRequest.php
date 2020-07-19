<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/1/30
 * Time: 下午 05:46
 */

namespace Modules\Classified\Http\Requests\Region;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class RegionStoreRequest extends BaseFormRequest
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
            'name'   => 'required|string|max:20',
            'status' => 'required|' . Rule::in(NYEnumConstants::enum()),
            'note'   => 'sometimes|required|string|max:255'
        ];
    }
}
