<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/2
 * Time: 下午 12:44
 */

namespace Modules\Selfie\Http\Requests\Manage\SelfieVideo;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class StoreRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getScheduleId()
    {
        return $this->get('selfie_schedule_id');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * @return UploadedFile|null
     */
    public function getCover()
    {
        return $this->file('cover');
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
    public function getReleaseData()
    {
        return $this->get('release_date');
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
            'selfie_schedule_id' => 'required|integer',
            'title'              => 'required|string',
            'cover'              => 'sometimes|required|image|dimensions:min_width=263,min_height=300',
            'video'              => 'sometimes|required|mimetypes:video/avi,video/mpeg,video/mp4',
            'release_date'       => 'required|string|date_format:Y-m-d H:i:s',
            'status'             => 'required|string|' . Rule::in(NYEnumConstants::enum()),
        ];
    }
}
