<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/2
 * Time: 下午 04:53
 */

namespace Modules\Member\Http\Requests\Client;

use Modules\Base\Http\Requests\BaseFormRequest;

class MyFavoriteActionRequestHandle extends BaseFormRequest
{
    /**
     * @return int|null
     */
    public function getMediaId()
    {
        return $this->get('media_id');
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
            'media_id' => 'required|integer',
        ];
    }
}
