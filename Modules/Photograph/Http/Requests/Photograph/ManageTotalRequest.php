<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 03:24
 */

namespace Modules\Photograph\Http\Requests\Photograph;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class ManageTotalRequest extends BaseFormRequest
{
    /**
     * @return int|null
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
     * @return int|null
     */
    public function getCupId(): ?int
    {
        return $this->get('cup_id');
    }

    /**
     * @return int|null
     */
    public function getYearsId(): ?int
    {
        return $this->get('years_id');
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->get('status');
    }

    /**
     * @return array
     */
    public function getGenresId(): array
    {
        return $this->get('genres_ids', []);
    }

    /**
     * @return string|null
     */
    public function getKeyword(): ?string
    {
        return $this->get('keyword');
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
            'region_id'        => 'sometimes|required|integer',
            'av_actress_ids'   => 'sometimes|required|array',
            'av_actress_ids.*' => 'sometimes|required|integer',
            'cup_id'           => 'sometimes|required|integer',
            'years_id'         => 'sometimes|required|integer',
            'status'           => 'sometimes|required|string|' . Rule::in(NYEnumConstants::enum()),
            'genres_ids'       => 'sometimes|required|array',
            'genres_ids.*'     => 'sometimes|required|integer',
            'keyword'          => 'sometimes|required|string',
        ];
    }
}
