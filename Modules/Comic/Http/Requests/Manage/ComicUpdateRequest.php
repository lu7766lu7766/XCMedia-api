<?php

namespace Modules\Comic\Http\Requests\Manage;

class ComicUpdateRequest extends ComicEditRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['id'] = 'required|integer';
        $rules['remove_cover'] = 'sometimes|required|boolean';

        return $rules;
    }
}
