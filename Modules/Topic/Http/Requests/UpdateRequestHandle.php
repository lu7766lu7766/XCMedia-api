<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/6
 * Time: 上午 09:57
 */

namespace Modules\Topic\Http\Requests;

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
     * @return \Illuminate\Http\UploadedFile|null
     */
    public function getImage()
    {
        return $this->file('image');
    }

    /**
     * @return boolean
     */
    public function getRemoveImage()
    {
        return $this->get('remove_image', false);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'id'           => 'required|integer',
            'title'        => 'required|string',
            'status'       => 'required|' . Rule::in(NYEnumConstants::enum()),
            'remark'       => 'sometimes|required|string',
            'image'        => 'sometimes|required|image',
            'remove_image' => 'sometimes|required|boolean',
        ];
    }
}
