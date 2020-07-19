<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/26
 * Time: 下午 07:41
 */

namespace Modules\Selfie\Http\Requests\Manage\SelfieSchedule;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class IndexRequest extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getIsCensored()
    {
        return $this->get('is_censored');
    }

    /**
     * @return int|null
     */
    public function getRegionId()
    {
        return $this->get('region_id');
    }

    /**
     * @return array
     */
    public function getAVActressIds()
    {
        return $this->get('av_actress', []);
    }

    /**
     * @return int|null
     */
    public function getCupId()
    {
        return $this->get('cup_id');
    }

    /**
     * @return int|null
     */
    public function getYearsId()
    {
        return $this->get('years_id');
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string|null
     */
    public function getKeyword()
    {
        return $this->get('keyword');
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
            'is_censored'  => 'sometimes|required|string|' . Rule::in(NYEnumConstants::enum()),
            'region_id'    => 'sometimes|required|integer',
            'av_actress'   => 'sometimes|required|array',
            'av_actress.*' => 'sometimes|required|integer',
            'cup_id'       => 'sometimes|required|integer',
            'years_id'     => 'sometimes|required|integer',
            'status'       => 'sometimes|required|string|' . Rule::in(NYEnumConstants::enum()),
            'keyword'      => 'sometimes|required|string',
            'page'         => 'sometimes|required|integer|min:1',
            'perpage'      => 'sometimes|required|integer|between:1,100'
        ];
    }
}
