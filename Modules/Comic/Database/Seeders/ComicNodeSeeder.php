<?php

namespace Modules\Comic\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Comic\ManageComicNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class ComicNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * @inheritDoc
     */
    protected function parentName(): string
    {
        return '漫畫管理';
    }

    /**
     * @inheritDoc
     */
    protected function parentCode(): string
    {
        return ManageComicNodeCodeConstants::MANAGE_COMIC;
    }

    /**
     * @inheritDoc
     */
    protected function nodes(): Collection
    {
        return collect([
            ManageComicNodeCodeConstants::MANAGE_COMIC_READ   => '漫畫管理-讀取',
            ManageComicNodeCodeConstants::MANAGE_COMIC_CREATE => '漫畫管理-新增',
            ManageComicNodeCodeConstants::MANAGE_COMIC_UPDATE => '漫畫管理-編輯',
            ManageComicNodeCodeConstants::MANAGE_COMIC_DELETE => '漫畫管理-刪除',
        ]);
    }
}
