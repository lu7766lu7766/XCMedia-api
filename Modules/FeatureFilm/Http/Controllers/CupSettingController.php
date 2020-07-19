<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 下午 12:01
 */

namespace Modules\FeatureFilm\Http\Controllers;

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
        return CupUsedTypeConstants::FEATURE_FILM;
    }
}
