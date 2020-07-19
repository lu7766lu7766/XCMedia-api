<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/12
 * Time: 下午 06:47
 */

namespace Modules\Episode\Http\Requests;

use Modules\Base\Http\Requests\AbstractLaravelRequest;

class GetEpisodeOwnerIdRequestHandle extends AbstractLaravelRequest
{
    /**
     * @return int
     */
    public function getEpisodeOwnerId()
    {
        return $this->request->get('episode_owner_id');
    }

    /**
     * Request args validate rules.
     * @link https://laravel.com/docs/master/validation lookup link and know how to write rule.
     * @return array
     * @see https://laravel.com/docs/master/validation#available-validation-rules
     * checkout this to get more rule keyword info
     */
    protected function rules()
    {
        return [
            'episode_owner_id' => 'required|integer',
        ];
    }

    /**
     * Request args validate msg on fail.
     * @link https://laravel.com/docs/master/validation lookup link and know how to write message.
     * @return array
     * @see https://laravel.com/docs/master/validation#customizing-the-error-messages
     * checkout this to get more message info
     * @see https://laravel.com/docs/master/validation#working-with-error-messages
     * checkout this to get more message info
     */
    protected function messages()
    {
        return [];
    }
}
