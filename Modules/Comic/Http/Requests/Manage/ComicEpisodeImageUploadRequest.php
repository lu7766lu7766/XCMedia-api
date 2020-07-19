<?php

namespace Modules\Comic\Http\Requests\Manage;

use Illuminate\Http\UploadedFile;
use Modules\Base\Http\Requests\BaseFormRequest;

class ComicEpisodeImageUploadRequest extends BaseFormRequest
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
