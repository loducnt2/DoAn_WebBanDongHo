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
	    
        $customerCare->warranty_policy = $request->warranty_policy;
    	$customerCare->return_policy = $request->return_policy;
        $customerCare->info_security_policy = $request->info_security_policy;
        $customerCare->policy_foreigner = $request->policy_foreigner;
        $customerCare->delivery_policy = $request->delivery_policy;
        $customerCare->payment_guide = $request->payment_guide;
        $customerCare->shopping_guide = $request->shopping_guide;

    	$customerCare->save();
    	return redirect('admin/customercare/edit/'.$id)->with('notify', 'Cập nhật thành công!');
    }
}
