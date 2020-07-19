<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 06:07
 */

namespace Modules\Member\Http\Requests\Client\MemberViewed;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Episode\Constants\EpisodeMediaMorphConstants;

class EpisodeClearRequest extends BaseFormRequest
{
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->get('id');
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->get('type');
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
            'id'   => 'sometimes|required|integer',
            'type' => 'sometimes|required|string|' . Rule::in(EpisodeMediaMorphConstants::enum()),
        ];
    }
}
