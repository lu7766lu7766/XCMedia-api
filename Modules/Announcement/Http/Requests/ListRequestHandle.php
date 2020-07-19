<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/6
 * Time: 下午 06:28
 */

namespace Modules\Announcement\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class ListRequestHandle extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->get('title');
    }

    /**
     * @return string|null
     */
    public function getMarqueeSwitch()
    {
        return $this->get('marquee_switch');
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'title'          => 'sometimes|required|string',
            'marquee_switch' => 'sometimes|required|string|' . Rule::in(NYEnumConstants::enum()),
            'status'         => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
            'page'           => 'sometimes|required|integer|min:1',
            'perpage'        => 'sometimes|required|integer|between:1,100'
        ];
    }
}
