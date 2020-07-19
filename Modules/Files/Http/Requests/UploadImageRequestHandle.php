<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/10
 * Time: 下午 06:11
 */

namespace Modules\Files\Http\Requests;

use Illuminate\Http\UploadedFile;
use Modules\Base\Http\Requests\BaseFormRequest;

class UploadImageRequestHandle extends BaseFormRequest
{
    /**
     * @return UploadedFile
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
            'image' => 'required|image',
        ];
    }
}
