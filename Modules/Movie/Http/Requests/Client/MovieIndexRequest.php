<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2020/3/16
 * Time: 下午 03:14
 */

namespace Modules\Movie\Http\Requests\Client;

use Modules\Base\Http\Requests\BaseFormRequest;

class MovieIndexRequest extends BaseFormRequest
{
    /**
     * @return int|null
     */
    public function getRegionId()
    {
        return $this->get('region_id');
    }

    /**
     * @return int|null
     */
    public function getGenresId()
    {
        return $this->get('genres_id');
    }

    /**
     * @return int|null
     */
    public function getYearsId()
    {
        return $this->get('years_id');
    }

    /**
     * todo 好像沒有語系篩選
     * @return int
     */
    public function getLanguageId()
    {
        return $this->get('language_id');
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
            'region_id'   => 'sometimes|required|integer',
            'genres_id'   => 'sometimes|integer',
            'years_id'    => 'sometimes|required|integer',
            'language_id' => 'sometimes|required|integer',
            'name'        => 'sometimes|required|string|max:50',  //todo 好像沒用到
            'page'        => 'sometimes|required|integer|min:1',
            'perpage'     => 'sometimes|required|integer|between:1,100'
        ];
    }
}
