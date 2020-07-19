<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/17
 * Time: 下午 03:30
 */

namespace Modules\FeatureFilm\Http\Requests;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class EditVideoRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->get('id');
    }

    /**
     * @return UploadedFile
     */
    public function getVideo(): ?UploadedFile
    {
        return $this->file('video');
    }

    /**
     * @return string
     */
    public function getVideoStatus(): string
    {
        return $this->get('video_status');
    }

    /**
     * @return string
     */
    public function getOpenAt(): string
    {
        return $this->get('open_at');
    }

    /**
     * @return boolean
     */
    public function getRemoveVideo(): bool
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
            'video'        => 'sometimes|required|file|mimetypes:video/mpeg,video/mp4',
            'video_status' => 'required|string|' . Rule::in(NYEnumConstants::enum()),
            'open_at'      => 'required|date',
            'remove_video' => 'sometimes|required|boolean'
        ];
    }
}
