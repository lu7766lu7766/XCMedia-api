<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/6
 * Time: 上午 11:19
 */

namespace Modules\Member\Http\Requests\Client;

use Modules\Base\Http\Requests\BaseFormRequest;

class MyFavoriteDeleteRequestHandle extends BaseFormRequest
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
            'id' => 'required|integer',
        ];
    }
}
