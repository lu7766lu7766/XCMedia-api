<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/12
 * Time: 下午 02:06
 */

namespace Modules\Member\Http\Requests\Client;

use Modules\Base\Http\Requests\BaseFormRequest;

class MyFavoriteRemoveAllRequestHandle extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getMediaType()
    {
        return $this->get('media_type');
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
            'media_type' => 'sometimes|required|string',
        ];
    }
}
