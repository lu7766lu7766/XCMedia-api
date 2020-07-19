<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 04:36
 */

namespace Modules\Video\Http\Controllers;

use Modules\Classified\Constants\AVActressUsedTypeConstants;
use Modules\Classified\Http\Controllers\MediaActressController;

class AVActressSettingController extends MediaActressController
{
    /**
     * @see AVActressUsedTypeConstants
     * @return string
     */
    protected function genre(): string
    {
        return AVActressUsedTypeConstants::VIDEO;
    }
}
