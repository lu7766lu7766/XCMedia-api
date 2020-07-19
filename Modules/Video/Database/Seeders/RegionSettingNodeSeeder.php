<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/5
 * Time: 下午 06:07
 */

namespace Modules\Video\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Video\RegionSettingNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class RegionSettingNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '成人視頻-地區設定';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return RegionSettingNodeCodeConstants::VIDEO_REGION_SETTING;
    }

    /**
     * @inheritdoc
     */
    protected function nodes(): Collection
    {
        return collect([
            RegionSettingNodeCodeConstants::VIDEO_REGION_SETTING_READ   => '成人視頻-地區設定-讀取',
            RegionSettingNodeCodeConstants::VIDEO_REGION_SETTING_CREATE => '成人視頻-地區設定-新增',
            RegionSettingNodeCodeConstants::VIDEO_REGION_SETTING_UPDATE => '成人視頻-地區設定-編輯',
            RegionSettingNodeCodeConstants::VIDEO_REGION_SETTING_DELETE => '成人視頻-地區設定-刪除'
        ]);
    }
}
