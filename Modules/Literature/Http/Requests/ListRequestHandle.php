<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/04
 * Time: 下午 08:38
 */

namespace Modules\Literature\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class ListRequestHandle extends BaseFormRequest
{
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
    public function getYearId(): ?int
    {
        return $this->get('year_id');
    }

    /**
     * @return null|string
     */
    public function getStatus(): ?string
    {
        return $this->get('status');
    }

    /**
     * @return null|string
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
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->get('page', 1);
    }

    /**
     * @return int|null
     */
    public function getPerpage(): ?int
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
            'region_id'    => 'sometimes|required|integer',
            'year_id'      => 'sometimes|required|integer',
            'status'       => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
            'genres_ids'   => 'sometimes|required|array',
            'genres_ids.*' => 'integer',
            'title'        => 'sometimes|required|string',
            'page'         => 'sometimes|required|integer',
            'perpage'      => 'sometimes|required|integer',
        ];
    }
}
