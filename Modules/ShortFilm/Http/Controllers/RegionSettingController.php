<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/4
 * Time: 下午 04:17
 */

namespace Modules\ShortFilm\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Constants\RegionUsedTypeConstants;
use Modules\Classified\Http\Controllers\MediaRegion;

class RegionSettingController extends Controller
{
    use MediaRegion;

    /**
     * @return string
     * @see RegionUsedTypeConstants
     */
    protected function genre(): string
    {
        return RegionUsedTypeConstants::SHORT_FILM;
    }
}
