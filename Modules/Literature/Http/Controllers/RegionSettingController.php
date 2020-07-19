<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/5
 * Time: 下午 07:39
 */

namespace Modules\Literature\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return RegionUsedTypeConstants::LITERATURE;
    }
}
