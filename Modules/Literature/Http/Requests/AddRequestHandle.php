<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/04
 * Time: 下午 06:31
 */

namespace Modules\Literature\Http\Requests;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class AddRequestHandle extends BaseFormRequest
{
    /**
     * @return UploadedFile|null
     */
    public function getCover(): ?UploadedFile
    {
        return $this->file('cover');
    }

    /**
     * @return int
     */
    public function getRegionId(): int
    {
        return $this->get('region_id');
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->get('title');
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
    public function getStatus(): string
    {
        return $this->get('status');
    }

    /**
     * @return null|String
     */
    public function getDescription(): ?String
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
     * @return null|String
     */
    public function getAlias(): ?String
    {
        return $this->get('alias');
    }

    /**
     * @return null|String
     */
    public function getTags(): ?String
    {
        return $this->get('tags');
    }

    /**
     * @return array
     */
    public function getImageIds(): array
    {
        return $this->get('image_ids', []);
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
            'cover'        => 'sometimes|required|image|dimensions:max_width=500,max_height=500',
            'title'        => 'required|string|max:20',
            'region_id'    => 'required|integer',
            'genres_ids'   => 'required|array',
            'genres_ids.*' => 'integer',
            'year_id'      => 'required|integer',
            'status'       => 'required|' . Rule::in(NYEnumConstants::enum()),
            'description'  => 'sometimes|required|string',
            'views'        => 'sometimes|required|integer|min:0',
            'score'        => 'sometimes|required|numeric|between:0,10|regex:/^\d{1,2}(\.\d)?/',
            'alias'        => 'sometimes|required|string|max:20',
            'tags'         => 'sometimes|required|string',
            'image_ids'    => 'sometimes|required|array',
            'image_ids.*'  => 'integer'
        ];
    }
}
