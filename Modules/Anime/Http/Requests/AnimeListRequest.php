<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/16
 * Time: 下午 03:05
 */

namespace Modules\Anime\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Episode\Constants\EpisodeStatusConstants;

class AnimeListRequest extends BaseFormRequest
{
    /**
     * @return array
     */
    public function getGenresIds(): array
    {
        return $this->get('genres_ids', []);
    }

    /**
     * @return int|null
     */
    public function getRegionId(): ?int
    {
        return $this->get('region_id');
    }

    /**
     * @return int|null
     */
    public function getYearsId(): ?int
    {
        return $this->get('years_id');
    }

    /**
     * @return null|string
     */
    public function getEpisodeStatus(): ?string
    {
        return $this->get('episode_status');
    }

    /**
     * @return int|null
     */
    public function getLanguageId(): ?int
    {
        return $this->get('language_id');
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * @return int
     */
    public function getPerpage()
    {
        return $this->get('perpage', 20);
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
            'genres_ids'     => 'sometimes|required|array',
            'genres_ids.*'   => 'sometimes|required|integer',
            'region_id'      => 'sometimes|required|integer',
            'years_id'       => 'sometimes|required|integer',
            'language_id'    => 'sometimes|required|integer',
            'episode_status' => 'sometimes|required|string|' . Rule::in(EpisodeStatusConstants::enum()),
            'page'           => 'sometimes|required|integer|min:1',
            'perpage'        => 'sometimes|required|integer|between:1,100'
        ];
    }
}
