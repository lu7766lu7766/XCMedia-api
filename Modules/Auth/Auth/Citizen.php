<?php
/**
 * Created by PhpStorm.
 * User: House
 * Date: 2018/10/5
 * Time: 下午 02:22
 */

namespace Modules\Auth\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Database\Eloquent\Model;
use Modules\Account\Constants\AccountStatusConstants;

class Citizen extends EloquentUserProvider
{
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        /** @var Model|\Illuminate\Contracts\Auth\Authenticatable $model */
        $model = $this->createModel();

        return $model->newQuery()
            ->where($model->getAuthIdentifierName(), $identifier)
            ->where('status', AccountStatusConstants::ENABLE)
            ->first();
    }
}
