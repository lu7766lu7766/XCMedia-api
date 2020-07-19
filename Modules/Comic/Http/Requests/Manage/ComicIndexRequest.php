<?php

namespace Modules\Comic\Http\Requests\Manage;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class ComicIndexRequest extends BaseFormRequest
{
    /**
     * @return int|null
     */
    public function getRegionId()
    {
        return $this->get('region_id');
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
     * @see NYEnumConstants::enum()
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->get('name');
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
            'region_id' => 'sometimes|required|integer',
            'years_id'  => 'sometimes|required|integer',
            'status'    => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
            'name'      => 'sometimes|required|string|max:50',
            'page'      => 'sometimes|required|integer|min:1',
            'perpage'   => 'sometimes|required|integer|between:1,100'
        ];
    }
}
