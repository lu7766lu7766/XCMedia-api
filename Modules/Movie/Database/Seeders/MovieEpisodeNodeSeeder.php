<?php

namespace Modules\Movie\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Movie\ManageMovieNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class MovieEpisodeNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '影音電影-集數設定';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return ManageMovieNodeCodeConstants::MANAGE_MOVIE_EPISODE;
    }

    /**
     * 子節點集合,key為子節點code,value為子節點名稱
     * nodes collect
     * node code put at key
     * node name put at value
     * @return Collection
     */
    protected function nodes(): Collection
    {
        return collect([
            ManageMovieNodeCodeConstants::MANAGE_MOVIE_EPISODE_READ   => '電影管理-集數設定-讀取',
            ManageMovieNodeCodeConstants::MANAGE_MOVIE_EPISODE_CREATE => '電影管理-集數設定-新增',
            ManageMovieNodeCodeConstants::MANAGE_MOVIE_EPISODE_UPDATE => '電影管理-集數設定-編輯',
            ManageMovieNodeCodeConstants::MANAGE_MOVIE_EPISODE_DELETE => '電影管理-集數設定-刪除',
        ]);
    }
}
