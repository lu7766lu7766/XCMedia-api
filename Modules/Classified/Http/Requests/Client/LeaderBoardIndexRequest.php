<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 04:43
 */

namespace Modules\Classified\Http\Requests\Client;

use Modules\Base\Http\Requests\BaseFormRequest;

class LeaderBoardIndexRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getTopCount(): int
    {
        return $this->get('top_count', 10);
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
            'top_count' => 'sometimes|required|integer'
        ];
    }
}
