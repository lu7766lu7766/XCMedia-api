<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/14
 * Time: 下午 05:22
 */

namespace Modules\Drama\Http\Requests;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Episode\Constants\EpisodeStatusConstants;

class UpdateRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * @return UploadedFile|null
     */
    public function getImage()
    {
        return $this->file('image');
    }

    /**
     * @return string|null
     */
    public function getAlias()
    {
        return $this->get('alias');
    }

    /**
     * @return string|null
     */
    public function getEpisodeStatus()
    {
        return $this->get('episode_status');
    }

    /**
     * @return string|null
     */
    public function getStarring()
    {
        return $this->get('starring');
    }

    /**
     * @return string|null
     */
    public function getDirector()
    {
        return $this->get('director');
    }

    /**
     * @return int
     */
    public function getRegionId()
    {
        return $this->get('region_id');
    }

    /**
     * @return array
     */
    public function getGenreIds()
    {
        return $this->get('genre_ids', []);
    }

    /**
     * @return int
     */
    public function getYearsId()
    {
        return $this->get('years_id');
    }

    /**
     * @return int
     */
    public function getLanguageId()
    {
        return $this->get('language_id');
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->get('description');
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return array
     */
    public function getEditorImageIds()
    {
        return $this->get('editor_image_ids', []);
    }

    /**
     * @return boolean
     */
    public function getRemoveImage()
    {
        return $this->get('remove_image', false);
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->get('score', 0);
    }

    /**
     * @return int
     */
    public function getViews(): int
    {
        return $this->get('views', 0);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'id'                 => 'required|integer',
            'title'              => 'required|string|max:50',
            'image'              => 'sometimes|required|image',
            'alias'              => 'sometimes|required|string|max:50',
            'episode_status'     => 'sometimes|required|' . Rule::in(EpisodeStatusConstants::enum()),
            'starring'           => 'sometimes|required|string|max:255',
            'director'           => 'sometimes|required|string|max:255',
            'region_id'          => 'required|integer',
            'genre_ids'          => 'required|array',
            'genre_ids.*'        => 'integer',
            'years_id'           => 'required|integer',
            'language_id'        => 'required|integer',
            'description'        => 'sometimes|required|string',
            'status'             => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
            'editor_image_ids'   => 'sometimes|required|array',
            'editor_image_ids.*' => 'integer',
            'remove_image'       => 'sometimes|required|boolean',
            'score'              => 'sometimes|required|between:0,10|regex:/^\d{1,2}\.?\d{0,1}$/',
            'views'              => 'sometimes|required|integer|min:0',
        ];
    }
}
