<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/8
 * Time: 下午 07:48
 */

namespace Modules\Advertisement\Http\Requests;

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
     * @return string|null
     */
    public function getUrl()
    {
        return $this->get('url');
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
    public function getIsBlank()
    {
        return $this->get('is_blank', NYEnumConstants::NO);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return \Illuminate\Http\UploadedFile
     */
    public function getImage()
    {
        return $this->file('image');
    }

    /**
     * @return int
     */
    public function getTypeId()
    {
        return $this->get('type_id');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'title'      => 'required|string|max:50',
            'url'        => 'sometimes|required|string|max:255',
            'branches'   => 'required|array',
            'branches.*' => 'integer',
            'is_blank'   => 'required|string|' . Rule::in(NYEnumConstants::enum()),
            'status'     => 'required|' . Rule::in(NYEnumConstants::enum()),
            'image'      => 'required|image',
            'type_id'    => 'required|integer'
        ];
    }
}
