<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/11
 * Time: 下午 06:01
 */

namespace Modules\Storytelling\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;
use Modules\Node\Constants\Storytelling\ManageStorytellingNodeCodeConstants;

class StorytellingNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * @inheritDoc
     */
    protected function parentName(): string
    {
        return '成人說書';
    }

    /**
     * @inheritDoc
     */
    protected function parentCode(): string
    {
        return ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING;
    }

    /**
     * @inheritDoc
     */
    protected function nodes(): Collection
    {
        return collect([
            ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_READ   => '成人說書-讀取',
            ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_CREATE => '成人說書-新增',
            ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_UPDATE => '成人說書-編輯',
            ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_DELETE => '成人說書-刪除',
        ]);
    }
}
