<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 01:51
 */

namespace Modules\Classified\Http\Requests\AVActress;

use Modules\Base\Http\Requests\BaseFormRequest;

class AVActressInfoRequest extends BaseFormRequest
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
