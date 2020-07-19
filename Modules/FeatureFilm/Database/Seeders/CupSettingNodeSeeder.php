<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/7
 * Time: 下午 12:54
 */

namespace Modules\FeatureFilm\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\FeatureFilm\CupSettingNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class CupSettingNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '成人長片-罩杯設定';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return CupSettingNodeCodeConstants::FEATURE_FILM_CUP_SETTING;
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
            CupSettingNodeCodeConstants::FEATURE_FILM_CUP_SETTING_READ   => '成人長片-罩杯設定-讀取',
            CupSettingNodeCodeConstants::FEATURE_FILM_CUP_SETTING_CREATE => '成人長片-罩杯設定-新增',
            CupSettingNodeCodeConstants::FEATURE_FILM_CUP_SETTING_UPDATE => '成人長片-罩杯設定-編輯',
            CupSettingNodeCodeConstants::FEATURE_FILM_CUP_SETTING_DELETE => '成人長片-罩杯設定-刪除'
        ]);
    }
}
