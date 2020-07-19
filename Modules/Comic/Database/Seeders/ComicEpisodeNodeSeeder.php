<?php

namespace Modules\Comic\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Comic\ManageComicNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class ComicEpisodeNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * @inheritDoc
     */
    protected function parentName(): string
    {
        return '漫畫管理-集數設定';
    }

    /**
     * @inheritDoc
     */
    protected function parentCode(): string
    {
        return ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE;
    }

    /**
     * @inheritDoc
     */
    protected function nodes(): Collection
    {
        return collect([
            ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE_READ   => '漫畫管理-集數設定-讀取',
            ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE_CREATE => '漫畫管理-集數設定-新增',
            ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE_UPDATE => '漫畫管理-集數設定-編輯',
            ManageComicNodeCodeConstants::MANAGE_COMIC_EPISODE_DELETE => '漫畫管理-集數設定-刪除',
        ]);
    }
}
