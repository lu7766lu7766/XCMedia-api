<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/17
 * Time: 下午 03:30
 */

namespace Modules\ShortFilm\Http\Requests;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\ShortFilm\Constants\MosaicConstants;

class EditRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->get('id');
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->get('title');
    }

    /**
     * @return UploadedFile
     */
    public function getCover(): ?UploadedFile
    {
        return $this->file('cover');
    }

    /**
     * @return string
     */
    public function getAlias(): ?string
    {
        return $this->get('alias');
    }

    /**
     * @return string
     */
    public function getMosaicType(): string
    {
        return $this->get('mosaic_type');
    }

    /**
     * @return int
     */
    public function getRegionId(): int
    {
        return $this->get('region_id');
    }

    /**
     * @return array
     */
    public function getAVActressIds(): array
    {
        return $this->get('av_actress_ids', []);
    }

    /**
     * @return int
     */
    public function getCupId(): int
    {
        return $this->get('cup_id');
    }

    /**
     * @return array
     */
    public function getGenresIds(): array
    {
        return $this->get('genres_ids', []);
    }

    /**
     * @return int
     */
    public function getYearId(): int
    {
        return $this->get('year_id');
    }

    /**
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->get('tags');
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->get('description');
    }

    /**
     * @return int
     */
    public function getViews()
    {
        return $this->get('views', 0);
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->get('score', 0);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('status');
    }

    /**
     * @return string
     */
    public function getVideoStatus(): string
    {
        return $this->get('video_status');
    }

    /**
     * @return array
     */
    public function getImageIds(): array
    {
        return $this->get('image_ids', []);
    }

    /**
     * @return boolean
     */
    public function getRemoveCover(): bool
    {
        return $this->get('remove_cover', false);
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
            'id'               => 'required|integer',
            'title'            => 'required|string|max:20',
            'cover'            => 'sometimes|required|image|dimensions:max_width=263,max_height=300',
            'alias'            => 'sometimes|required|string|max:20',
            'mosaic_type'      => 'required|string|' . Rule::in(MosaicConstants::enum()),
            'region_id'        => 'required|integer',
            'av_actress_ids'   => 'required|array',
            'av_actress_ids.*' => 'integer',
            'cup_id'           => 'required|integer',
            'genres_ids'       => 'required|array',
            'genres_ids.*'     => 'integer',
            'year_id'          => 'required|integer',
            'tags'             => 'sometimes|required|string',
            'description'      => 'sometimes|required|string',
            'views'            => 'sometimes|required|integer|min:0',
            'score'            => 'sometimes|required|numeric|between:0,10|regex:/^\d{1,2}(\.\d)?/',
            'status'           => 'required|string|' . Rule::in(NYEnumConstants::enum()),
            'video_status'     => 'sometimes|required|string|' . Rule::in(NYEnumConstants::enum()),
            'image_ids'        => 'sometimes|required|array',
            'image_ids.*'      => 'integer',
            'remove_cover'     => 'sometimes|required|boolean'
        ];
    }
}
