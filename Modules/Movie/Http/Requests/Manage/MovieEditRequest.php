<?php

namespace Modules\Movie\Http\Requests\Manage;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Episode\Constants\EpisodeStatusConstants;

class MovieEditRequest extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->get('name');
    }

    /**
     * @return \Illuminate\Http\UploadedFile|null
     */
    public function getCover()
    {
        return $this->file('cover');
    }

    /**
     * @return string|null
     */
    public function getAlias()
    {
        return $this->get('alias');
    }

    /**
     * @return string
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
     * @return string
     * @see NYEnumConstants::enum()
     */
    public function getStatus()
    {
        return $this->get('status');
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
     * @return \Illuminate\Http\UploadedFile[]|array
     */
    public function getImageIds()
    {
        return $this->get('image_ids', []);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'name'           => 'required|string|max:50',
            'cover'          => 'sometimes|required|image|dimensions:max_width=263,max_height=300',
            'alias'          => 'sometimes|required|string|max:50',
            'episode_status' => 'required|sometimes|' . Rule::in(EpisodeStatusConstants::enum()),
            'starring'       => 'sometimes|required|string|max:255',
            'director'       => 'sometimes|required|string|max:255',
            'region_id'      => 'required|integer',
            'genre_ids'      => 'required|array',
            'genre_ids.*'    => 'integer',
            'years_id'       => 'required|integer',
            'language_id'    => 'required|integer',
            'description'    => 'sometimes|required',
            'status'         => 'required|' . Rule::in(NYEnumConstants::enum()),
            'views'          => 'sometimes|required|integer|min:0',
            'score'          => 'sometimes|required|numeric|between:0,10|regex:/^\d{1,2}(\.\d)?/',
            'image_ids'      => 'sometimes|required|array',
            'image_ids.*'    => 'integer',
        ];
    }
}
