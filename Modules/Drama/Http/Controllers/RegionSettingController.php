<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/1/30
 * Time: 下午 06:56
 */

namespace Modules\Drama\Http\Controllers;

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
        return RegionUsedTypeConstants::DRAMA;
    }
}
