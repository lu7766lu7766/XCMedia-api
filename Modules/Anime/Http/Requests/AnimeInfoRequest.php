<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 上午 10:58
 */

namespace Modules\Anime\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class AnimeInfoRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
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
            'id' => 'required|integer'
        ];
    }
}
