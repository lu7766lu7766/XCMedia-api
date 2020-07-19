<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/11
 * Time: 下午 12:00
 */

namespace Modules\Anime\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Anime\Repositories\AnimeRepo;
use Modules\Classified\Contracts\IClassifiedRepo;
use Modules\Member\Http\Controllers\MemberComment;

class CommentController extends Controller
{
    use MemberComment;

    /**
     * @return IClassifiedRepo
     */
    public function getClassifiedRepo(): IClassifiedRepo
    {
        return new AnimeRepo();
    }
}
