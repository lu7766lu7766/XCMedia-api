<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/1/30
 * Time: 下午 03:43
 */

namespace Modules\Classified\Http\Requests\Genres;

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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'title'  => 'required|string',
            'status' => 'required|' . Rule::in(NYEnumConstants::enum()),
            'remark' => 'sometimes|required|string',
            'image'  => 'sometimes|required|image',
        ];
    }
}
