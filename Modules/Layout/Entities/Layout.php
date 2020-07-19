<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/15
 * Time: 下午 03:06
 */

namespace Modules\Layout\Entities;

use Modules\Base\Entities\BaseORM;
use Modules\Branch\Entities\PublishBranchHelper;
use Modules\Files\Entities\EditorFilesUsedHelper;

class Layout extends BaseORM
{
    use EditorFilesUsedHelper, PublishBranchHelper;
    protected $table = 'layout';
    protected $fillable = [
        'title',
        'code',
        'contents',
        'status'
    ];
}
