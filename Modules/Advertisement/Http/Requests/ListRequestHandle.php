<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/9
 * Time: 下午 04:52
 */

namespace Modules\Advertisement\Http\Requests;

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
    public function getTypeId()
    {
        return $this->get('type_id');
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
            'title'   => 'sometimes|required|string|max:50',
            'status'  => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
            'type_id' => 'sometimes|required|integer',
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100'
        ];
    }
}
