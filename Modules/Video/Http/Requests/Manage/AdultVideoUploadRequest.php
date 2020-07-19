<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/4/1
 * Time: 下午 04:29
 */

namespace Modules\Video\Http\Requests\Manage;

use Illuminate\Http\UploadedFile;
use Modules\Base\Http\Requests\BaseFormRequest;

class AdultVideoUploadRequest extends BaseFormRequest
{
    /**
     * @return UploadedFile
     */
    public function getImage()
    {
        return $this->file('image');
    }

    /**
     * Request args validate rules.
     * @link https://laravel.com/docs/master/validation lookup link and know how to write rule.
     * @return array
     * @see https://laravel.com/docs/master/validation#available-validation-rules
     * checkout this to get more rule keyword info
     */
    public function rules()
    {
        return [
            'image' => 'required|image',
        ];
    }
}
