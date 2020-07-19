<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 下午 06:01
 */

namespace Modules\Classified\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Classified\Constants\ClassifiedConstant;

class ClassifiedSearchRequest extends BaseFormRequest
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
     * @return int
     */
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * @return int
     */
    public function getPerpage()
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
            'type'    => 'required|string|' . Rule::in([
                    ClassifiedConstant::DRAMA,
                    ClassifiedConstant::MOVIE,
                    ClassifiedConstant::ANIME,
                    ClassifiedConstant::VARIETY
                ]),
            'keyword' => 'required|string',
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100'
        ];
    }
}
