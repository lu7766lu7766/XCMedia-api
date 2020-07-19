<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2018/9/13
 * Time: 下午 03:41
 */

namespace Modules\Base\Support\Logger\Handler;

use Illuminate\Contracts\Filesystem\Filesystem;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class FileSystemHandler extends AbstractProcessingHandler
{
    /**
     * @var Filesystem
     */
    protected $storage;
    /**
     * @var string
     */
    protected $rootFolder;
    protected $filename;

    /**
     * FileSystemHandler constructor.
     * @param string $storage file system driver.
     * @param string $root the destination folder path base of the storage.<br>
     * e.g. if storage path is /account/project/storage, the destination path is first/second/three ,
     * the really path will be /account/project/storage/first/second/three
     * @param string $filename
     * @param int $level
     * @param bool $bubble
     */
    public function __construct(
        string $storage,
        string $root,
        string $filename,
        $level = Logger::DEBUG,
        bool $bubble = true
    ) {
        parent::__construct($level, $bubble);
        $this->storage = \Storage::disk($storage);
        $this->rootFolder = $root;
        $this->filename = $filename;
    }

    /**
     * Writes the record down to the log of the implementing handler
     *
     * @param  array $record
     * data example(monolog logger):
     * <pre>
     * array(
     *      'message' => (string) $message,
     *      'context' => $context,
     *      'level' => $level,
     *      'level_name' => $levelName,
     *      'channel' => $this->name,
     *      'datetime' => $ts,
     *      'extra' => array(),
     *      'formatted' => mixed // see $this->formatter() return.
     * );
     * <\pre>
     * @return void
     */
    protected function write(array $record): void
    {
        $path = $this->rootFolder . DIRECTORY_SEPARATOR
            . date('Y-m-d') . DIRECTORY_SEPARATOR
            . date('H') . '-' . $this->filename;
        $this->storage->append($path, $record['formatted']);
    }
}
