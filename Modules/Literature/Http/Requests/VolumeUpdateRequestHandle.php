<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/10
 * Time: 下午 07:20
 */

namespace Modules\Literature\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class VolumeUpdateRequestHandle extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->get('title');
    }

    /**
     * @return null|string
     */
    public function getVolumeContent(): ?string
    {
        return $this->get('content');
    }

    /**
     * @return string
     */
    public function getOpenAt(): string
    {
        return $this->get('open_at');
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->get('status');
    }

    /**
     * @return array
     */
    public function getImageIds(): array
    {
        return $this->get('image_ids', []);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->get('id');
    }

    /**
     * @return int
     */
    public function getLiteratureId(): int
    {
        return $this->get('literature_id');
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
            'id'            => 'required|integer',
            'literature_id' => 'required|integer',
            'title'         => 'required|string',
            'content'       => 'sometimes|required|string',
            'open_at'       => 'required|date',
            'status'        => 'required|' . Rule::in(NYEnumConstants::enum()),
            'image_ids'     => 'sometimes|required|array',
            'image_ids.*'   => 'integer',
        ];
    }
}
