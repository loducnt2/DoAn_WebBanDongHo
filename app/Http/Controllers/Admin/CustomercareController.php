<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customercare;

class CustomercareController extends Controller
{
    public function getList(Request $request){
       $customerCare = Customercare::all();
    	return view('admin.customercare.list', ['customerCare' => $customerCare]);
    }

    public function getEdit($id){
    	$customerCare = Customercare::find($id);
    	return view('admin.customercare.edit', compact('customerCare'));
    }
    public function postEdit(Request $request, $id){
	    $customerCare = Customercare::find($id);
	    
    	$customerCare->return_policy = $request->return_policy;
        $customerCare->policy_foreigner = $request->policy_foreigner;
        $customerCare->delivery_time = $request->delivery_time;

    	$customerCare->save();
    	return redirect('admin/customercare/edit/'.$id)->with('notify', 'Cập nhật thành công!');
    }
}
