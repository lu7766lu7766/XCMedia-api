<?php

namespace Modules\Comic\Http\Requests\Manage;

use Modules\Base\Http\Requests\BaseFormRequest;

class ComicEpisodeListRequest extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getComicId()
    {
        return $this->get('comic_id');
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
            'comic_id' => 'required|integer',
            'page'     => 'sometimes|required|integer|min:1',
            'perpage'  => 'sometimes|required|integer|between:1,100'
        ];
    }
}
