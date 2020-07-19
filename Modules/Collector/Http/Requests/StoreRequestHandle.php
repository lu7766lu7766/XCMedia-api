<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/5/6
 * Time: 下午 03:18
 */

namespace Modules\Collector\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class StoreRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getSourceId()
    {
        return $this->get('source_id');
    }

    /**
     * @return array
     */
    public function getTypeIds()
    {
        return $this->get('type_ids', []);
    }

    /**
     * @return array
     */
    public function getPlatformIds()
    {
        return $this->get('platform_ids', []);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'source_id'      => 'required|integer',
            'type_ids'       => 'required|array',
            'type_ids.*'     => 'integer',
            'platform_ids'   => 'required|array',
            'platform_ids.*' => 'integer',
            'status'         => 'required|' . Rule::in(NYEnumConstants::enum()),
        ];
    }
}
