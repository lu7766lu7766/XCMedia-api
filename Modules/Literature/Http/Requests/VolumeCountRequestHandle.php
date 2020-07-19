<?php
/**
 * Created by PhpStorm.
 * User: arxing
 * Date: 2020/03/10
 * Time: 下午 07:20
 */

namespace Modules\Literature\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class VolumeCountRequestHandle extends BaseFormRequest
{
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
            'literature_id' => 'required|integer',
        ];
    }
}
