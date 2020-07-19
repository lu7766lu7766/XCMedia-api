<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/13
 * Time: 下午 05:22
 */

namespace Modules\FAQ\Entities;

use Modules\Base\Entities\BaseORM;
use Modules\Branch\Entities\PublishBranchHelper;
use Modules\Files\Entities\EditorFilesUsedHelper;

class FAQ extends BaseORM
{
    use EditorFilesUsedHelper, PublishBranchHelper;
    protected $table = 'faq';
    protected $fillable = [
        'title',
        'contents',
        'status'
    ];
}
