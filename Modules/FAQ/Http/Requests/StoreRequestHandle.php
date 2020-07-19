<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/13
 * Time: 下午 05:47
 */

namespace Modules\FAQ\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class StoreRequestHandle extends BaseFormRequest
{
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
    public function getContents()
    {
        return $this->get('contents');
    }

    /**
     * @return array
     */
    public function getBranches()
    {
        return $this->get('branches');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return array
     */
    public function getImageIds()
    {
        return $this->get('image_ids', []);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'title'       => 'required|string|max:50',
            'contents'    => 'required|string',
            'branches'    => 'required|array',
            'branches.*'  => 'integer',
            'status'      => 'required|' . Rule::in(NYEnumConstants::enum()),
            'image_ids'   => 'sometimes|required|array',
            'image_ids.*' => 'integer',
        ];
    }
}

