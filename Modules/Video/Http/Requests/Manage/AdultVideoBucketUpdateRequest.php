<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 03:54
 */

namespace Modules\Video\Http\Requests\Manage;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class AdultVideoBucketUpdateRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @return UploadedFile|null
     */
    public function getVideo()
    {
        return $this->file('video');
    }

    /**
     * @return string
     */
    public function getReleaseTime()
    {
        return $this->get('release_time');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return boolean
     */
    public function getRemoveVideo()
    {
        return $this->get('remove_video', false);
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
            'id'           => 'required|integer',
            'video'        => 'sometimes|required|file|mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime',
            'release_time' => 'required|string|date_format:Y-m-d H:i:s',
            'status'       => 'required|string|' . Rule::in(NYEnumConstants::enum()),
            'remove_video' => 'sometimes|required|boolean',
        ];
    }
}
