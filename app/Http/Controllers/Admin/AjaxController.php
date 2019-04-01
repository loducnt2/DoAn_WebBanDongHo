<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Trademark;

class AjaxController extends Controller
{
    public function getTrade($idCategory){
    	$trade = Trademark::where('idCategory', $idCategory)->get();

    	/*echo "<pre>";
    		print_r($trade);
    	die();*/
    	
    	
    	foreach ($trade as $item) {
    		echo "<option value='".$item->id."'>".$item->name_trade."</option>";
    	}
    }
}
