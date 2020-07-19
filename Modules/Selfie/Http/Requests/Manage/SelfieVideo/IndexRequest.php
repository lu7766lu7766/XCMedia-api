<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/27
 * Time: 下午 07:28
 */

namespace Modules\Selfie\Http\Requests\Manage\SelfieVideo;

use Modules\Base\Http\Requests\BaseFormRequest;

class IndexRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getScheduleId()
    {
        return $this->get('selfie_schedule_id');
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * @return int
     */
    public function getPerpage()
    {
        return $this->get('perpage', 25);
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
            'selfie_schedule_id' => 'required|int',
            'page'               => 'sometimes|required|integer|min:1',
            'perpage'            => 'sometimes|required|integer|between:1,100'
        ];
    }
}
