<?php

namespace Modules\Member\Http\Requests\Client\Comment;

use Modules\Base\Http\Requests\BaseFormRequest;

/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/10
 * Time: 下午 04:56
 */
class MemberCommentAddRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getMediaId()
    {
        return $this->get('media_id');
    }

    /**
     * @return string
     */
    public function getContents()
    {
        return $this->get('contents');
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
            'contents' => 'required|string'
        ];
    }
}
