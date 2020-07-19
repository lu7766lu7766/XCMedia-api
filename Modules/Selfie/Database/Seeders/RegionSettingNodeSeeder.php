<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/4
 * Time: 下午 05:53
 */

namespace Modules\Selfie\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Selfie\RegionSettingNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class RegionSettingNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '成人自拍-地區設定';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return RegionSettingNodeCodeConstants::SELFIE_REGION_SETTING;
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
            RegionSettingNodeCodeConstants::SELFIE_REGION_SETTING_READ   => '成人自拍-地區設定-讀取',
            RegionSettingNodeCodeConstants::SELFIE_REGION_SETTING_CREATE => '成人自拍-地區設定-新增',
            RegionSettingNodeCodeConstants::SELFIE_REGION_SETTING_UPDATE => '成人自拍-地區設定-編輯',
            RegionSettingNodeCodeConstants::SELFIE_REGION_SETTING_DELETE => '成人自拍-地區設定-刪除'
        ]);
    }
}
