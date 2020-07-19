<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/17
 * Time: 下午 03:30
 */

namespace Modules\FeatureFilm\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\FeatureFilm\Constants\MosaicConstants;

class TotalRequestHandle extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getMosaicType(): ?string
    {
        return $this->get('mosaic_type');
    }

    /**
     * @return int
     */
    public function getRegionId(): ?int
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
    public function getCupId(): ?int
    {
        return $this->get('cup_id');
    }

    /**
     * @return int
     */
    public function getYearId(): ?int
    {
        return $this->get('year_id');
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->get('status');
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
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
     * Request args validate rules.
     * @link https://laravel.com/docs/master/validation lookup link and know how to write rule.
     * @return array
     * @see https://laravel.com/docs/master/validation#available-validation-rules
     * checkout this to get more rule keyword info
     */
    public function rules()
    {
        return [
            'mosaic_type'      => 'sometimes|required|string|' . Rule::in(MosaicConstants::enum()),
            'region_id'        => 'sometimes|required|integer',
            'av_actress_ids'   => 'sometimes|required|array',
            'av_actress_ids.*' => 'integer',
            'genres_ids'       => 'sometimes|required|array',
            'genres_ids.*'     => 'integer',
            'cup_id'           => 'sometimes|required|integer',
            'year_id'          => 'sometimes|required|integer',
            'status'           => 'sometimes|required|string|' . Rule::in(NYEnumConstants::enum()),
            'title'            => 'sometimes|required|string',
        ];
    }
}
