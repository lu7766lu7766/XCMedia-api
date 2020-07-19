<?php

namespace Modules\Role\Http\Requests;

use Modules\Base\Http\Requests\BaseFormRequest;

/**
 * Public role attach nodes.
 * Class PublicRoleAuthorizationRequest
 * @package Modules\Role\Http\Requests
 */
class PublicRoleAuthorizationRequest extends BaseFormRequest
{
    /**
     * Role Id
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
    }

    /**
     * Node Ids
     * @return array
     */
    public function getNodes()
    {
        return $this->get('nodes', []);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'id'      => 'required|integer',
            'nodes'   => 'sometimes|required|array',
            'nodes.*' => 'required|integer|min:1'
        ];
    }
}
