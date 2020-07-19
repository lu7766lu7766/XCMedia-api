<?php

namespace Modules\Base\Http\Controllers;

use Illuminate\Http\Request;

class BaseTestController extends BaseController
{
    /**
     * A simple method for use.
     * @param Request $request
     * @return array
     */
    public function simple(Request $request)
    {
        return $request->all();
    }
}
