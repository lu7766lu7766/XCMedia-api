<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 03:31
 */

namespace Modules\Video\Http\Requests\Manage;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class AdultVideoBucketStoreRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getAdultVideoId()
    {
        return $this->get('adult_video_id');
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
     * Request args validate rules.
     * @link https://laravel.com/docs/master/validation lookup link and know how to write rule.
     * @return array
     * @see https://laravel.com/docs/master/validation#available-validation-rules
     * checkout this to get more rule keyword info
     */
    public function rules()
    {
        return [
            'adult_video_id' => 'required|int',
            'video'          => 'sometimes|required|file|mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime',
            'release_time'   => 'required|string|date_format:Y-m-d H:i:s',
            'status'         => 'required|string|' . Rule::in(NYEnumConstants::enum())
        ];
    }
}
