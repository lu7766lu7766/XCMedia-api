<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/3/12
 * Time: 下午 06:55
 */

namespace Modules\Storytelling\Database\Seeders;

use Illuminate\Support\Collection;
use Modules\Node\Constants\Storytelling\ManageStorytellingNodeCodeConstants;
use Modules\Node\Database\Seeders\TreeNodeBindSeeder;

class StorytellingAudioNodeSeeder extends TreeNodeBindSeeder
{
    /**
     * @inheritDoc
     */
    protected function parentName(): string
    {
        return '成人說書-語音管理';
    }

    /**
     * @inheritDoc
     */
    protected function parentCode(): string
    {
        return ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_AUDIO;
    }

    /**
     * @inheritDoc
     */
    protected function nodes(): Collection
    {
        return collect([
            ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_AUDIO_READ   => '成人說書-語音管理-讀取',
            ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_AUDIO_CREATE => '成人說書-語音管理-新增',
            ManageStorytellingNodeCodeConstants::MANAGE_STORYTELLING_AUDIO_DELETE => '成人說書-語音管理-刪除',
        ]);
    }
}
