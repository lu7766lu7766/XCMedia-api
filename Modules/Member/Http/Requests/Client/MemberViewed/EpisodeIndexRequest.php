<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/5
 * Time: 下午 03:23
 */

namespace Modules\Member\Http\Requests\Client\MemberViewed;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Episode\Constants\EpisodeMediaMorphConstants;

class EpisodeIndexRequest extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->get('type');
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->get('page', 1);
    }

    /**
     * @return int
     */
    public function getPerpage(): int
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
            'type'    => 'sometimes|required|string|' . Rule::in(EpisodeMediaMorphConstants::enum()),
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|max:100',
        ];
    }
}
