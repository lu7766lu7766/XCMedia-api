<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/04/13
 * Time: 下午 06:54
 */

namespace Modules\Episode\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class BatchStoreRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getEpisodeOwnerId(): int
    {
        return $this->get('episode_owner_id');
    }

    /**
     * @return int
     */
    public function getSourceId(): int
    {
        return $this->get('source_id');
    }

    /**
     * @return string
     */
    public function getData(): array
    {
        return $this->get('data', []);
    }

    /**
     * @return string
     */
    public function getOpeningTime(): string
    {
        return $this->get('opening_time');
    }

    /**
     * @return
     */
    public function getStatus(): string
    {
        return $this->get('status');
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
            'episode_owner_id' => 'required|integer',
            'source_id'        => 'required|integer',
            'data'             => 'required|array',
            'data.*.url'       => 'string',
            'data.*.name'      => 'string',
            'opening_time'     => 'required|date',
            'status'           => 'required|' . Rule::in(NYEnumConstants::enum()),
        ];
    }
}
