<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/10
 * Time: 下午 04:44
 */

namespace Modules\Drama\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Contracts\IClassifiedRepo;
use Modules\Drama\Repositories\DramaRepo;
use Modules\Member\Http\Controllers\MemberComment;

class CommentController extends Controller
{
    use MemberComment;

    /**
     * @return IClassifiedRepo
     */
    public function getClassifiedRepo(): IClassifiedRepo
    {
        return new DramaRepo();
    }
}
