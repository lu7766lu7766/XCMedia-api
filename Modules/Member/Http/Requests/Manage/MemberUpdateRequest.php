<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/2/5
 * Time: 下午 04:01
 */

namespace Modules\Member\Http\Requests\Manage;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;
use Modules\Member\Constants\MemberStatusConstants;

class MemberUpdateRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->get('display_name');
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->get('password');
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->get('phone');
    }

    /**
     * @return string
     */
    public function getPhoneApprove()
    {
        return $this->get('phone_approve');
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->get('mail');
    }

    /**
     * @return string
     */
    public function getMailApprove()
    {
        return $this->get('mail_approve');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string
     */
    public function getRemark()
    {
        return $this->get('remark');
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
            'id'            => 'required|integer',
            'display_name'  => 'required|alpha_num',
            'password'      => 'sometimes|required|string|between:4,32',
            'phone'         => 'sometimes|required|digits:11',
            'phone_approve' => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
            'mail'          => 'sometimes|required|email',
            'mail_approve'  => 'sometimes|required|' . Rule::in(NYEnumConstants::enum()),
            'status'        => 'required|' . Rule::in(MemberStatusConstants::common()),
            'remark'        => 'sometimes|required|string'
        ];
    }
}
