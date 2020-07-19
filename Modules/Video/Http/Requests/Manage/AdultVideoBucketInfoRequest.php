<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 03:19
 */

namespace Modules\Video\Http\Requests\Manage;

use Modules\Base\Http\Requests\BaseFormRequest;

class AdultVideoBucketInfoRequest extends BaseFormRequest
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
