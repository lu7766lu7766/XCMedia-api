<?php
/**
 * Created by PhpStorm.
 * User: ed
 * Date: 2019/12/16
 * Time: 下午 05:28
 */

namespace Modules\Node\Service;

use Modules\Node\Entities\NodeGroup;
use Modules\Node\Repository\ManageNodeGroupRepo;
use XC\Independent\Kit\Support\Traits\Pattern\Singleton;

class ManageNodeGroupService
{
    use Singleton;
    /**
     * @var null|ManageNodeGroupRepo
     */
    private $repo;

    /**
     * Initialize class.
     */
    protected function init()
    {
        $this->repo = $this->repo ?: app(ManageNodeGroupRepo::class);
    }

    /**
     * @param string $displayName
     * @param string $code
     * @param string $enable
     * @param string $display
     * @param string $public
     * @return NodeGroup|null
     * @see NYEnumConstants handle $enable, $display, $public value
     */
    public function updateOrCreate(
        string $displayName,
        string $code,
        string $enable = 'Y',
        string $display = 'Y',
        string $public = 'Y'
    ) {
        $group = $this->repo->findByCode($code) ?? new NodeGroup();
        $result = $this->repo->save($group, [
            'display_name' => $displayName,
            'code'         => $code,
            'enable'       => $enable,
            'display'      => $display,
            'public'       => $public
        ]) ? $group : null;

        return $result;
    }
}
