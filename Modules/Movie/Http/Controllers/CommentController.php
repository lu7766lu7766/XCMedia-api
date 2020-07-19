<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/11
 * Time: 下午 01:36
 */

namespace Modules\Movie\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Contracts\IClassifiedRepo;
use Modules\Member\Http\Controllers\MemberComment;
use Modules\Movie\Repositories\MovieRepo;

class CommentController extends Controller
{
    use MemberComment;

    /**
     * @return IClassifiedRepo
     */
    public function getClassifiedRepo(): IClassifiedRepo
    {
        return new MovieRepo();
    }
}
