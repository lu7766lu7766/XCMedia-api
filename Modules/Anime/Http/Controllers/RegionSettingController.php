<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/1/30
 * Time: 下午 06:07
 */

namespace Modules\Anime\Http\Controllers;

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
        return RegionUsedTypeConstants::ANIME;
    }
}
