<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/26
 * Time: 下午 04:18
 */

namespace Modules\Node\Service;

use Modules\Base\Constants\NYEnumConstants;
use Modules\Node\Entities\Node;
use Modules\Node\Entities\NodeGroup;
use Modules\Node\Repository\ManageNodeRepo;
use XC\Independent\Kit\Support\Traits\Pattern\Singleton;

class ManageNodeService
{
    use Singleton;
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed|ManageNodeRepo
     */
    private $repo;

    /**
     * Initialize class.
     */
    protected function init()
    {
        $this->repo = $this->repo ?: app(ManageNodeRepo::class);
    }

    /**
     * @param NodeGroup $nodeGroup
     * @param string $displayName
     * @param string $code
     * @param string $enable
     * @param string $display
     * @param string $public
     * @return \Illuminate\Database\Eloquent\Model|Node
     * @see NYEnumConstants handle $enable, $display, $public value
     */
    public function edit(
        NodeGroup $nodeGroup,
        string $displayName,
        string $code,
        string $enable = 'Y',
        string $display = 'Y',
        string $public = 'Y'
    ) {
        $attributes = ['code' => $code];
        $insert = [
            'display_name' => $displayName,
            'code'         => $code,
            'enable'       => $enable,
            'display'      => $display,
            'public'       => $public
        ];

        return $nodeGroup->nodes()->updateOrCreate($attributes, $insert);
    }
}
