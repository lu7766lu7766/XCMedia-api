<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 04:19
 */

namespace Modules\Video\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Video\AdultVideoNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class AdultVideoNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '成人視頻-視頻管理';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return AdultVideoNodeCodeConstants::VIDEO_ADULT_VIDEO_MANAGE;
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
            AdultVideoNodeCodeConstants::VIDEO_ADULT_VIDEO_MANAGE_READ   => '成人視頻-視頻管理-讀取',
            AdultVideoNodeCodeConstants::VIDEO_ADULT_VIDEO_MANAGE_CREATE => '成人視頻-視頻管理-新增',
            AdultVideoNodeCodeConstants::VIDEO_ADULT_VIDEO_MANAGE_UPDATE => '成人視頻-視頻管理-編輯',
            AdultVideoNodeCodeConstants::VIDEO_ADULT_VIDEO_MANAGE_DELETE => '成人視頻-視頻管理-刪除',
        ]);
    }
}
