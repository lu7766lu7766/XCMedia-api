<?php

namespace Modules\Base\Http\Controllers;

use Illuminate\Routing\Controller;
use XC\Independent\Kit\Support\Scalar\ArrayMaster;
use XC\Independent\Kit\Support\Scalar\StringMaster;

abstract class BaseController extends Controller
{
    /**
     * @var array
     */
    protected $req;

    public function __construct()
    {
        $this->req = request()->all();
    }

    /**
     * @return array
     */
    protected function getReq()
    {
        return $this->req;
    }

    /**
     * 根據psr4 spec,在nwidart/laravel-modules package中 ,排除prefix(Modules root folder)後的第一段namespace當作module name.
     * @return string
     */
    public function moduleName()
    {
        $class = static::class;
        $classes = ArrayMaster::explode(StringMaster::replace($class, '\\', '/'), '/');

        return $classes[1] ?? '';
    }
}
