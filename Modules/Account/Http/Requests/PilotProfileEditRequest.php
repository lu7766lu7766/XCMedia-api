<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/4
 * Time: 下午 01:03
 */

namespace Modules\Account\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

/**
 * Class PilotProfileEditRequest
 * @package Modules\Account\Http\Requests
 */
class PilotProfileEditRequest extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getOldPassword()
    {
        return $this->get('old_password');
    }

    /**
     * @return string|null
     */
    public function getNewPassword()
    {
        return $this->get('new_password');
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->get('display_name');
    }

    /**
     * @return \Illuminate\Http\UploadedFile|null
     */
    public function getCover()
    {
        return $this->file('cover');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $size = config('Account.config.cover_max_size');

        return [
            'old_password' => 'sometimes|required|string|between:4,32',
            'new_password' => 'sometimes|required|string|between:4,32|confirmed',
            'display_name' => 'required|alpha_num|between:4,32',
            'cover'        => [
                'sometimes',
                'required',
                'image',
                'max:256',
                'dimensions:max_width=' . $size . ',max_height=' . $size,
            ]
        ];
    }
}
