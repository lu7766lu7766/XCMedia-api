<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 04:25
 */

namespace Modules\Photograph\Http\Requests\Photograph;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class ManageUpdateRequest extends BaseFormRequest
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
     * @return UploadedFile|null
     */
    public function getCover(): ?UploadedFile
    {
        return $this->file('cover');
    }

    /**
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->get('alias');
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
    public function getAvActressIds(): array
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
    public function getYearsId(): int
    {
        return $this->get('years_id');
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->get('tags', []);
    }

    /**
     * @return null|string
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
     * @return null|string
     */
    public function getStatus(): ?string
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
            'cover'            => 'sometimes|required|image',
            'alias'            => 'sometimes|required|string',
            'region_id'        => 'required|integer',
            'av_actress_ids'   => 'required|array',
            'av_actress_ids.*' => 'required|integer',
            'cup_id'           => 'required|integer',
            'genres_ids'       => 'required|array',
            'genres_ids.*'     => 'required|integer',
            'years_id'         => 'required|integer',
            'tags'             => 'sometimes|required|array',
            'description'      => 'sometimes|required|string|max:255',
            'views'            => 'sometimes|required|integer|min:0',
            'score'            => 'sometimes|required|numeric|between:0,10|regex:/^\d{1,2}(\.\d)?/',
            'status'           => 'required|string|' . Rule::in(NYEnumConstants::enum()),
            'remove_cover'     => 'sometimes|required|boolean',
        ];
    }
}
