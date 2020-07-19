<?php

namespace Modules\Movie\Http\Requests\Manage;

class MovieUpdateRequest extends MovieEditRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * @return boolean
     */
    public function getRemoveCover()
    {
        return $this->get('remove_cover', false);
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
