<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/16
 * Time: 下午 02:46
 */

namespace Modules\Variety\Http\Requests\Client;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Episode\Constants\EpisodeStatusConstants;

class ListRequestHandle extends BaseFormRequest
{
    /**
     * @return int|null
     */
    public function getGenresId()
    {
        return $this->get('genres_id');
    }

    /**
     * @return int|null
     */
    public function getRegionId()
    {
        return $this->get('region_id');
    }

    /**
     * @return int|null
     */
    public function getYearsId()
    {
        return $this->get('years_id');
    }

    /**
     * @return int|null
     */
    public function getLanguageId()
    {
        return $this->get('language_id');
    }

    /**
     * @return string|null
     */
    public function getEpisodeStatus()
    {
        return $this->get('episode_status');
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'genres_id'      => 'sometimes|required|integer',
            'region_id'      => 'sometimes|required|integer',
            'years_id'       => 'sometimes|required|integer',
            'language_id'    => 'sometimes|required|integer',
            'episode_status' => 'sometimes|required|' . Rule::in(EpisodeStatusConstants::enum()),
            'page'           => 'sometimes|required|integer|min:1',
            'perpage'        => 'sometimes|required|integer|between:1,100'
        ];
    }
}
