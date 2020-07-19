<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/2
 * Time: 下午 04:14
 */

namespace Modules\Selfie\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Selfie\SelfieScheduleNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class SelfieScheduleNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '成人自拍-自拍管理';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return SelfieScheduleNodeCodeConstants::SELFIE_SCHEDULE;
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
            SelfieScheduleNodeCodeConstants::SELFIE_SCHEDULE_READ   => '成人自拍-自拍管理-讀取',
            SelfieScheduleNodeCodeConstants::SELFIE_SCHEDULE_CREATE => '成人自拍-自拍管理-新增',
            SelfieScheduleNodeCodeConstants::SELFIE_SCHEDULE_UPDATE => '成人自拍-自拍管理-編輯',
            SelfieScheduleNodeCodeConstants::SELFIE_SCHEDULE_DELETE => '成人自拍-自拍管理-刪除'
        ]);
    }
}
