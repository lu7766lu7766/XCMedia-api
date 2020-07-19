<?php

namespace Modules\Files\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FilesController extends Controller
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
