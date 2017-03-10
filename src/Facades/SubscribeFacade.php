<?php

namespace Story\Subscribe\Facades;

use Illuminate\Support\Facades\Facade;

class SubscribeFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'subscribe';
    }
}
