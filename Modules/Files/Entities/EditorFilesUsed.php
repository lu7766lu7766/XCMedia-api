<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/13
 * Time: 下午 04:01
 */

namespace Modules\Files\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EditorFilesUsed extends Pivot
{
    protected $table = 'editor_files_used';
}
