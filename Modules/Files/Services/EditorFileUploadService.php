<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/1/10
 * Time: 下午 08:26
 */

namespace Modules\Files\Services;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Modules\Files\Repositories\EditorFilesRepo;

class EditorFileUploadService
{
    /** @var Cloud $storage */
    private $storage;
    /** @var string $filePath */
    private $filePath;
    /** @var string $fileUrl */
    private $fileUrl;
    /** @var EditorFilesRepo $repo */
    private $repo;

    public function __construct(Cloud $storage)
    {
        $this->storage = $storage;
        $this->repo = new EditorFilesRepo();
    }

    /**
     * @param UploadedFile $file
     * @return \Modules\Files\Entities\EditorFiles|null
     */
    public function upload(UploadedFile $file)
    {
        $path = config('editor_file.file_path');
        $this->filePath = $this->storage->put($path, $file, Filesystem::VISIBILITY_PUBLIC);
        $this->fileUrl = $this->storage->url($this->filePath);
        $attributes = [
            'file_path' => $this->filePath,
            'file_url'  => $this->fileUrl
        ];

        return $this->repo->create($attributes);
    }

    /**
     * @param int $id
     * @return int
     */
    public function remove(int $id)
    {
        $result = 0;
        $file = $this->repo->findUnused($id);
        if (!is_null($file)) {
            $this->storage->delete($file->file_path);
            $result = $this->repo->delete($id);
        }

        return $result;
    }
}
