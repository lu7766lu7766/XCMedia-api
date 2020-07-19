<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/13
 * Time: 下午 02:26
 */

namespace Modules\Files\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait EditorFilesUsedHelper
 * @package Modules\Files\Entities
 * @property EditorFiles[]|Collection editorFiles
 */
trait EditorFilesUsedHelper
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function editorFiles()
    {
        return $this->morphToMany(
            EditorFiles::class,
            'used',
            'editor_files_used',
            'used_id',
            'editor_file_id'
        );
    }

    /**
     * @param Collection|Model|array $files
     */
    public function usedEditorFile($files)
    {
        $this->editorFiles()->sync($files);
    }

    /**
     *
     */
    public function cancelEditorFile()
    {
        $this->editorFiles()->detach();
    }
}
