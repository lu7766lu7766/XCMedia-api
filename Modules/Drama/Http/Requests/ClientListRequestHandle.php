<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/16
 * Time: 上午 11:56
 */

namespace Modules\Drama\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Classified\Constants\ClientListSortConstants;
use Modules\Episode\Constants\EpisodeStatusConstants;

class ClientListRequestHandle extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getSort()
    {
        return $this->get('sort', ClientListSortConstants::HOT);
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
            'sort'           => 'sometimes|required|string|' . Rule::in(ClientListSortConstants::enum()),
            'language_id'    => 'sometimes|required|integer',
            'years_id'       => 'sometimes|required|integer',
            'region_id'      => 'sometimes|required|integer',
            'genres_ids'     => 'sometimes|required|integer',
            'episode_status' => 'sometimes|required|' . Rule::in(EpisodeStatusConstants::enum()),
            'page'           => 'sometimes|required|integer|min:1',
            'perpage'        => 'sometimes|required|integer|between:1,100'
        ];
    }
}
