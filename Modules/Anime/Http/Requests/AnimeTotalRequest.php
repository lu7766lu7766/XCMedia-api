<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/16
 * Time: 下午 06:41
 */

namespace Modules\Anime\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Episode\Constants\EpisodeStatusConstants;

class AnimeTotalRequest extends BaseFormRequest
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
            'episode_status' => 'sometimes|required|string|' . Rule::in(EpisodeStatusConstants::enum()),
        ];
    }
}
