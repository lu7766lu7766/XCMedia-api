<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 上午 11:20
 */

namespace Modules\Photograph\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Photograph\PhotographyManageNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class PhotographyManageNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '成人寫真-寫真管理';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return PhotographyManageNodeCodeConstants::PHOTOGRAPH_MANAGE;
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
            PhotographyManageNodeCodeConstants::PHOTOGRAPH_MANAGE_READ   => '成人寫真-地區設定-讀取',
            PhotographyManageNodeCodeConstants::PHOTOGRAPH_MANAGE_CREATE => '成人寫真-地區設定-新增',
            PhotographyManageNodeCodeConstants::PHOTOGRAPH_MANAGE_UPDATE => '成人寫真-地區設定-編輯',
            PhotographyManageNodeCodeConstants::PHOTOGRAPH_MANAGE_DELETE => '成人寫真-地區設定-刪除'
        ]);
    }
}
