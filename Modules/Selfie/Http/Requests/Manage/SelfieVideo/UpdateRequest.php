<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/2
 * Time: 下午 01:52
 */

namespace Modules\Selfie\Http\Requests\Manage\SelfieVideo;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
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
     * @return boolean
     */
    public function getRemoveCover()
    {
        return $this->get('remove_cover', false);
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
            'title'        => 'required|string',
            'cover'        => 'sometimes|required|image|dimensions:min_width=263,min_height=300',
            'video'        => 'sometimes|required|mimetypes:video/avi,video/mpeg,video/mp4',
            'release_date' => 'required|string|date_format:Y-m-d H:i:s',
            'status'       => 'required|string|' . Rule::in(NYEnumConstants::enum()),
            'remove_cover' => 'sometimes|required|boolean',
            'remove_video' => 'sometimes|required|boolean',
        ];
    }
}
