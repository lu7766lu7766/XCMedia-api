<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/2/10
 * Time: 下午 03:46
 */

namespace Modules\ShortFilm\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\ShortFilm\AVActressSettingNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class AVActressSettingNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '成人短片-女優設定';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return AVActressSettingNodeCodeConstants::SHORT_FILM_AV_ACTRESS_SETTING;
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
            AVActressSettingNodeCodeConstants::SHORT_FILM_AV_ACTRESS_SETTING_READ   => '成人短片-女優設定-讀取',
            AVActressSettingNodeCodeConstants::SHORT_FILM_AV_ACTRESS_SETTING_CREATE => '成人短片-女優設定-新增',
            AVActressSettingNodeCodeConstants::SHORT_FILM_AV_ACTRESS_SETTING_UPDATE => '成人短片-女優設定-編輯',
            AVActressSettingNodeCodeConstants::SHORT_FILM_AV_ACTRESS_SETTING_DELETE => '成人短片-女優設定-刪除',
        ]);
    }
}
