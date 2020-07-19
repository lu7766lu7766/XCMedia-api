<?php

namespace Modules\Comic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ComicController extends Controller
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
