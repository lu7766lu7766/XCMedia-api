<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/3
 * Time: 下午 04:47
 */

namespace Modules\Video\Http\Requests\Manage;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class AdultVideoTotalRequest extends BaseFormRequest
{
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
    public function getAvActressIds()
    {
        return $this->get('av_actress_ids', []);
    }

    /**
     * @return int|null
     */
    public function getCupId()
    {
        return $this->get('cup_Id');
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
     * Request args validate rules.
     * @link https://laravel.com/docs/master/validation lookup link and know how to write rule.
     * @return array
     * @see https://laravel.com/docs/master/validation#available-validation-rules
     * checkout this to get more rule keyword info
     */
    public function rules()
    {
        return [
            'region_id'        => 'sometimes|required|integer',
            'av_actress_ids'   => 'sometimes|required|array',
            'av_actress_ids.*' => 'sometimes|required|integer',
            'cup_id'           => 'sometimes|required|integer',
            'years_id'         => 'sometimes|required|integer',
            'status'           => 'sometimes|required|string|' . Rule::in(NYEnumConstants::enum()),
            'keyword'          => 'sometimes|required|string',
        ];
    }
}
