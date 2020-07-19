<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/17
 * Time: 下午 05:17
 */

namespace Modules\Classified\Http\Requests\Source;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class UpdateRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string|null
     */
    public function getRemark()
    {
        return $this->get('remark');
    }

    /**
     * @return string|null
     */
    public function getAnalyzeAddress()
    {
        return $this->get('analyze_address');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'id'              => 'required|integer',
            'title'           => 'required|string',
            'status'          => 'required|' . Rule::in(NYEnumConstants::enum()),
            'remark'          => 'sometimes|required|string',
            'analyze_address' => 'sometimes|required|string'
        ];
    }
}
