<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 01:17
 */

namespace Modules\Classified\Http\Requests\AVActress;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\NYEnumConstants;
use Modules\Base\Http\Requests\BaseFormRequest;

class AVActressUpdateRequest extends BaseFormRequest
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
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * @return string|null
     */
    public function getAlias()
    {
        return $this->get('alias');
    }

    /**
     * @return UploadedFile||null
     */
    public function getCover()
    {
        return $this->file('cover');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string|null
     */
    public function getNote()
    {
        return $this->get('note');
    }

    /**
     * @return boolean
     */
    public function getRemoveCover()
    {
        return $this->get('remove_cover', false);
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
            'id'           => 'required|integer',
            'name'         => 'required|string|max:20',
            'alias'        => 'sometimes|required|string|max:20',
            'cover'        => 'sometimes|required|image|dimensions:max_width=263,max_height=300',
            'status'       => 'required|' . Rule::in(NYEnumConstants::enum()),
            'note'         => 'sometimes|required|string',
            'remove_cover' => 'sometimes|required|boolean',
        ];
    }
}
