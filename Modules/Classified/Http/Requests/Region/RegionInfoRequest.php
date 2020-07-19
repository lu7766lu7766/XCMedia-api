<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/1/30
 * Time: 下午 05:44
 */

namespace Modules\Classified\Http\Requests\Region;

use Modules\Base\Http\Requests\BaseFormRequest;

class RegionInfoRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
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
            'id' => 'required|integer',
        ];
    }
}
