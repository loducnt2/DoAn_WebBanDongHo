<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Trademark;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function getMenu(){
    	$trade = Trademark::take(10)->get();
        $cate = Category::all();
    	/*
    	 HOẶC
    	$brand = DB::table('brands')->take(2)->get();
    	*/

        /*echo "<pre>";
        print_r($brand->toArray());
        die();*/
    	return view('pages.home', compact('trade', 'cate'));
    }
}
