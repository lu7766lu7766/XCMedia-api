<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/5
 * Time: 下午 05:36
 */

namespace Modules\Member\Http\Requests\Client;

use Modules\Base\Http\Requests\BaseFormRequest;

class MyFavoriteListRequestHandle extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getMediaType()
    {
        return $this->get('media_type');
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
            'media_type' => 'sometimes|required|string',
            'page'       => 'sometimes|required|integer|min:1',
            'perpage'    => 'sometimes|required|integer|between:1,100'
        ];
    }
}
