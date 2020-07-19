<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/10
 * Time: 下午 05:36
 */

namespace Modules\Files\Entities;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Base\Entities\BaseORM;

/**
 * Class EditorFiles
 * @property string file_path
 * @package Modules\Files\Entities
 */
class EditorFiles extends BaseORM
{
    protected $table = 'editor_files';
    protected $fillable = [
        'file_path',
        'file_url'
    ];

    /**
     * @return HasMany
     */
    public function usingFile()
    {
        return $this->hasMany(EditorFilesUsed::class, 'editor_file_id', 'id');
    }
}
