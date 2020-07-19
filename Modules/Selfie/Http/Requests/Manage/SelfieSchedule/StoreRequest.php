<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/27
 * Time: 上午 11:42
 */

namespace Modules\Selfie\Http\Requests\Manage\SelfieSchedule;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class StoreRequest extends BaseFormRequest
{
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
     * @return string|null
     */
    public function getAlias()
    {
        return $this->get('alias');
    }

    /**
     * @return string
     */
    public function getIsCensored()
    {
        return $this->get('is_censored');
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
    public function getAvActressIds()
    {
        return $this->get('av_actress_ids');
    }

    /**
     * @return int
     */
    public function getCupId()
    {
        return $this->get('cup_id');
    }

    /**
     * @return array
     */
    public function getGenresIds()
    {
        return $this->get('genres_ids');
    }

    /**
     * @return int
     */
    public function getYearsId()
    {
        return $this->get('years_id');
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->get('tags', []);
    }

    /**
     * @return string|null
     */
    public function getDescription()
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
            'title'            => 'required|string',
            'cover'            => 'sometimes|required|image|dimensions:min_width=263,min_height=300',
            'alias'            => 'sometimes|required|string',
            'is_censored'      => 'required|string|' . Rule::in(NYEnumConstants::enum()),
            'region_id'        => 'required|integer',
            'av_actress_ids'   => 'required|array',
            'av_actress_ids.*' => 'required|integer',
            'cup_id'           => 'required|integer',
            'genres_ids'       => 'required|array',
            'genres_ids.*'     => 'required|integer',
            'years_id'         => 'required|integer',
            'tags'             => 'sometimes|required|array',
            'description'      => 'sometimes|required|string',
            'views'            => 'sometimes|required|integer|min:0',
            'score'            => 'sometimes|required|numeric|between:0,10|regex:/^\d{1,2}(\.\d)?/',
            'status'           => 'required|string|' . Rule::in(NYEnumConstants::enum())
        ];
    }
}
