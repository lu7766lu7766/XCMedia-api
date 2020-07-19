<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 下午 01:36
 */

namespace Modules\ShortFilm\Http\Controllers;

use Modules\Classified\Constants\CupUsedTypeConstants;
use Modules\Classified\Http\Controllers\MediaCupController;

class CupSettingController extends MediaCupController
{
    /**
     * @see CupUsedTypeConstants
     * @return string
     */
    protected function genre(): string
    {
        return CupUsedTypeConstants::SHORT_FILM;
    }
}
