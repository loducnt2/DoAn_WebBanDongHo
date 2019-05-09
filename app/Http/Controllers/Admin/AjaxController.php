<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Trademark;

use App\District;
use App\Commune;
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

    public function getHuyen($idProvince){
        $district = District::where('idTP', $idProvince)->get();

        foreach ($district as $item) {
            echo "<option value='".$item->maqh."'>".$item->name."</option>";
        }
    }
    public function getXaPhuong($idDistrict){
        $commune = Commune::where('idQH', $idDistrict)->get();

        foreach ($commune as $item) {
            echo "<option value='".$item->xaid."'>".$item->name."</option>";
        }
    }
}
