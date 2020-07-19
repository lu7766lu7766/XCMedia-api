<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/6
 * Time: 上午 11:51
 */

namespace Modules\Storytelling\Http\Controllers;

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
        return RegionUsedTypeConstants::STORYTELLING;
    }
}
