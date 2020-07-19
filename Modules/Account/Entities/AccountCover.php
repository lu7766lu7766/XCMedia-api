<?php

namespace Modules\Account\Entities;

use Modules\Base\Entities\BaseORM;

/**
 * Class AccountCover
 * @property string path
 * @package Modules\Account\Entities
 */
class AccountCover extends BaseORM
{
    protected $table = 'account_cover';
    protected $fillable = [
        'path'
    ];
}
