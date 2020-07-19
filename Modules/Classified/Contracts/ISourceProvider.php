<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2020/2/13
 * Time: 上午 11:53
 */

namespace Modules\Classified\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Modules\Classified\Entities\Source;

interface ISourceProvider
{
    /**
     * @param array $ids
     * @return Source[]|Collection
     */
    public function getByIds(array $ids);

    /**
     * @param string $mediaTYpe
     * @param int $mediaId
     * @return IQuotableEntire[]|Collection
     */
    public function getEnableOnlineByMedia(string $mediaTYpe, int $mediaId);

    /**
     * @param int $id
     * @param string|null $status
     * @return Source|null
     */
    public function find(int $id, string $status = null);
}
