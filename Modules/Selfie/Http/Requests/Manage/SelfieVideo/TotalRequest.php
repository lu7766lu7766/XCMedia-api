<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/2
 * Time: 下午 12:37
 */

namespace Modules\Selfie\Http\Requests\Manage\SelfieVideo;

use Modules\Base\Http\Requests\BaseFormRequest;

class TotalRequest extends BaseFormRequest
{
    /**
     * @return mixed
     */
    public function getScheduleId()
    {
        return $this->get('selfie_schedule_id');
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
            'selfie_schedule_id' => 'required|integer',
        ];
    }
}
