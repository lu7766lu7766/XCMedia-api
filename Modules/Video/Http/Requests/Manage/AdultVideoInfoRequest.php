<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/3
 * Time: 下午 04:50
 */

namespace Modules\Video\Http\Requests\Manage;

use Modules\Base\Http\Requests\BaseFormRequest;

class AdultVideoInfoRequest extends BaseFormRequest
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
            'id' => 'required|integer'
        ];
    }
}
