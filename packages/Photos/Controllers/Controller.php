<?php

namespace PhpSoft\Photos\Controllers;

use Auth;
use App\Http\Controllers\Controller as AppController;

class Controller extends AppController
{
    /**
     * Check authentication
     * 
     * @return boolean
     */
    public function checkAuth()
    {
        return !empty(Auth::user());
    }

    /**
     * Check permission
     * 
     * @return boolean
     */
    public function checkPermission($permission)
    {
        return Auth::user()->can($permission) || Auth::user()->hasRole('admin');
    }
}
