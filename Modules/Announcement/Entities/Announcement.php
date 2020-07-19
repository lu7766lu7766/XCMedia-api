<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/6
 * Time: 下午 06:11
 */

namespace Modules\Announcement\Entities;

use Modules\Base\Entities\BaseORM;
use Modules\Branch\Entities\PublishBranchHelper;
use Modules\Files\Entities\EditorFilesUsedHelper;

class Announcement extends BaseORM
{
    use EditorFilesUsedHelper, PublishBranchHelper;
    protected $table = 'announcement';
    protected $fillable = [
        'title',
        'contents',
        'marquee_switch',
        'status'
    ];
}
