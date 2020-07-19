<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/5
 * Time: 下午 01:14
 */

namespace Modules\Base\Support\Logger;

use Monolog\Handler\RotatingFileHandler;

class DateTimeClassifyFileHandle extends RotatingFileHandler
{
    protected $timeFormat = 'H';

    protected function getTimedFilename(): string
    {
        $fileInfo = pathinfo($this->filename);
        $timedFilename = str_replace(
            ['{filename}', '{date}'],
            [$fileInfo['filename'], date($this->timeFormat)],
            $fileInfo['dirname']
            . DIRECTORY_SEPARATOR
            . date($this->dateFormat)
            . DIRECTORY_SEPARATOR
            . $this->filenameFormat
        );
        if (!empty($fileInfo['extension'])) {
            $timedFilename .= '.' . $fileInfo['extension'];
        }

        return $timedFilename;
    }
}
