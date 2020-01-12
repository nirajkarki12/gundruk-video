<?php

namespace App\User\Http\Controllers;

use App\Common\Http\Controllers\BaseController;

class AdminController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');  
    }

    public function dashboard() {
        return "hre";
    }
}
