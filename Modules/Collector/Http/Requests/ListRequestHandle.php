<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/7
 * Time: 下午 02:44
 */

namespace Modules\Collector\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class ListRequestHandle extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
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
     * @return string|null
     */
    public function getKeyword(): ?string
    {
        return $this->get('keyword', null);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'status'  => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100',
            'keyword' => 'sometimes|required|string',
        ];
    }
}
