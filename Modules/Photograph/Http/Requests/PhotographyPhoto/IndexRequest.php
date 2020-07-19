<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/9
 * Time: 下午 06:59
 */

namespace Modules\Photograph\Http\Requests\PhotographyPhoto;

use Modules\Base\Http\Requests\BaseFormRequest;

class IndexRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getPhotographId(): int
    {
        return $this->get('photography_id');
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
            'photography_id' => 'required|integer'
        ];
    }
}
