<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/12
 * Time: 上午 11:58
 */

namespace Modules\Storytelling\Http\Requests\Manage\Storytelling;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class ListRequestHandle extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return int|null
     */
    public function getYearsId()
    {
        return $this->get('years_id');
    }

    /**
     * @return int|null
     */
    public function getRegionId()
    {
        return $this->get('region_id');
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
        return $this->get('perpage', 20);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'title'     => 'sometimes|required|string|max:50',
            'years_id'  => 'sometimes|required|integer',
            'region_id' => 'sometimes|required|integer',
            'status'    => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
            'page'      => 'sometimes|required|integer|min:1',
            'perpage'   => 'sometimes|required|integer|between:1,100'
        ];
    }
}
