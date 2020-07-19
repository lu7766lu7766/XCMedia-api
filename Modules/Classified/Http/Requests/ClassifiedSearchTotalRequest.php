<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 下午 06:44
 */

namespace Modules\Classified\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Classified\Constants\ClassifiedConstant;

class ClassifiedSearchTotalRequest extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->get('type');
    }

    /**
     * @return string
     */
    public function getKeyword(): string
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
            'type'    => 'required|string|' . Rule::in([
                    ClassifiedConstant::DRAMA,
                    ClassifiedConstant::MOVIE,
                    ClassifiedConstant::ANIME,
                    ClassifiedConstant::VARIETY
                ]),
            'keyword' => 'required|string',
        ];
    }
}
