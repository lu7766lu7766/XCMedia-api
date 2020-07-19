<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/3/11
 * Time: 下午 01:49
 */

namespace Modules\Variety\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Classified\Contracts\IClassifiedRepo;
use Modules\Member\Http\Controllers\MemberComment;
use Modules\Variety\Repositories\VarietyRepo;

class CommentController extends Controller
{
    use MemberComment;

    /**
     * @return IClassifiedRepo
     */
    public function getClassifiedRepo(): IClassifiedRepo
    {
        return new VarietyRepo();
    }
}
