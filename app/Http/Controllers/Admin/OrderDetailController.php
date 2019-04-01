<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orderdetail;

class OrderDetailController extends Controller
{
    public function getList(){
    	$detail = Orderdetail::orderBy('id','DESC')->paginate(15);
    	return view('admin.orderdetail.list', ['detail' => $detail]);
    }
}
