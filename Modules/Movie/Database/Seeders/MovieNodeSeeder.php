<?php

namespace Modules\Movie\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Movie\ManageMovieNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class MovieNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '電影管理';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return ManageMovieNodeCodeConstants::MANAGE_MOVIE;
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
            ManageMovieNodeCodeConstants::MANAGE_MOVIE_READ   => '電影管理-讀取',
            ManageMovieNodeCodeConstants::MANAGE_MOVIE_CREATE => '電影管理-新增',
            ManageMovieNodeCodeConstants::MANAGE_MOVIE_UPDATE => '電影管理-編輯',
            ManageMovieNodeCodeConstants::MANAGE_MOVIE_DELETE => '電影管理-刪除',
        ]);
    }
}
