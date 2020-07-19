<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/2
 * Time: 下午 04:33
 */

namespace Modules\Selfie\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Selfie\SelfieVideoNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class SelfieVideoNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '成人自拍-影片管理列表';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return SelfieVideoNodeCodeConstants::SELFIE_VIDEO;
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
            SelfieVideoNodeCodeConstants::SELFIE_VIDEO_READ   => '成人自拍-影片管理列表-讀取',
            SelfieVideoNodeCodeConstants::SELFIE_VIDEO_CREATE => '成人自拍-影片管理列表-新增',
            SelfieVideoNodeCodeConstants::SELFIE_VIDEO_UPDATE => '成人自拍-影片管理列表-編輯',
            SelfieVideoNodeCodeConstants::SELFIE_VIDEO_DELETE => '成人自拍-影片管理列表-刪除'
        ]);
    }
}
