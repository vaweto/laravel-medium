<?php

namespace Vaweto\Medium\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vaweto\Medium\Medium
 */
class Medium extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Vaweto\Medium\Medium::class;
    }
}
