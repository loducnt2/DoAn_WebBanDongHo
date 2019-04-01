<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\User;
use Auth;

use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct(){
        //$this->login();
	} // Cần khai báo use View để dùng được View share;

	/*function login(){
		if(Auth::check()){
			view()->share('user_adminlogin', Auth::user());
		}
	}*/
}
