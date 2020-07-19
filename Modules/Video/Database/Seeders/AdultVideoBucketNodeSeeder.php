<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/4
 * Time: 下午 07:00
 */

namespace Modules\Video\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Video\AdultVideoBucketNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class AdultVideoBucketNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '成人視頻-視頻影片管理';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return AdultVideoBucketNodeCodeConstants::VIDEO_ADULT_VIDEO_BUCKET_MANAGE;
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
            AdultVideoBucketNodeCodeConstants::VIDEO_ADULT_VIDEO_BUCKET_MANAGE_READ   => '成人視頻-視頻影片管理-讀取',
            AdultVideoBucketNodeCodeConstants::VIDEO_ADULT_VIDEO_BUCKET_MANAGE_CREATE => '成人視頻-視頻影片管理-新增',
            AdultVideoBucketNodeCodeConstants::VIDEO_ADULT_VIDEO_BUCKET_MANAGE_UPDATE => '成人視頻-視頻影片管理-編輯',
        ]);
    }
}
