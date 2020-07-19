<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/17
 * Time: 上午 11:38
 */

namespace Modules\Anime\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

class AnimeCommentListRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->get('id');
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->get('page', 1);
    }

    /**
     * @return int
     */
    public function getPerpage(): int
    {
        return $this->get('perpage', 25);
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
            'id'      => 'required|integer',
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100'
        ];
    }
}
