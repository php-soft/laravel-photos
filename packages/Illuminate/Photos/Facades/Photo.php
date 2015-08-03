<?php

namespace PhpSoft\Illuminate\Photos\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Session\SessionManager
 * @see \Illuminate\Session\Store
 */
class Photo extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'phpsoft.photo';
    }
}
