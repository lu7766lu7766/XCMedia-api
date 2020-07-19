<?php
/**
 * Created by PhpStorm.
 * User: derek
 * Date: 2020/3/10
 * Time: 下午 01:17
 */

namespace Modules\Photograph\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Photograph\PhotographyPhotoNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class PhotographPhotoNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * 父節點名稱
     * @return string
     */
    protected function parentName(): string
    {
        return '成人寫真-寫真管理-圖片管理';
    }

    /**
     * 父節點代碼
     * @return string
     */
    protected function parentCode(): string
    {
        return PhotographyPhotoNodeCodeConstants::PHOTOGRAPH_PHOTO;
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
            PhotographyPhotoNodeCodeConstants::PHOTOGRAPH_PHOTO_READ   => '成人寫真-寫真管理-圖片管理-讀取',
            PhotographyPhotoNodeCodeConstants::PHOTOGRAPH_PHOTO_CREATE => '成人寫真-寫真管理-圖片管理-新增',
            PhotographyPhotoNodeCodeConstants::PHOTOGRAPH_PHOTO_DELETE => '成人寫真-寫真管理-圖片管理-刪除'
        ]);
    }
}
