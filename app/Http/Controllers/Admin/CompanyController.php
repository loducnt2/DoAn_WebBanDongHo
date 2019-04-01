<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

class CompanyController extends Controller
{
    public function getList(Request $request){
       $company = Company::paginate(15);
    	return view('admin.company.list', ['company' => $company]);
    }

    public function getEdit($id){
    	$company = Company::find($id);
    	return view('admin.company.edit', compact('company', 'company'));
    }
    public function postEdit(Request $request, $id){
    	$validatedData = $request->validate([
	        'name_company' => 'required|min:2',
	        'email_company' => 'required',
	        'address_company' => 'required',
	        'phone_company' => 'required|regex:/^(0)[0-9]{9}$/',
	        'avatar_company' => 'unique:companies'
	    ], 
    		[
    			'name_company.required'=>'Tên đămg nhập bắt buộc phải nhập !!!',
    			'name_company.min'=>'Tên từ 2 - 100 ký tự nhé !!!',

    			'email_company' => 'Bạn chưa nhập email',

    			'address_company.required'=>'Bạn chưa nhập địa chỉ !!!',

    			'phone_company.required'=>'Bạn chưa số điện thoại !!!',
    			'phone_company.regex'=>'Số điện thoại không đúng định dạng !!!',

    			'avatar_company.unique'=>'Tên ảnh này đã tồn tại !!!'
    		]
	    );

	    $company = Company::find($id);
    	$company->name_company = $request->name_company;

    	if($request->hasFile("avatar_company")){
	    	$fileAnh = $request->File("avatar_company");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/company/edit/'. $id)->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/company".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}

	    	$fileAnh->move("upload/company", $newName);
            //unlink("upload/company/" .$company->avatar_company);
	    	$company->avatar_company = $newName;
	    }
	   /* echo "<pre>";
	    echo $request->avatar_company;
	    die();*/

    	$company->email_company = $request->email_company;
    	$company->phone_company = $request->phone_company;
    	$company->address_company = $request->address_company;
    	$company->link_fb = $request->link_fb;
    	$company->link_twiter = $request->link_twiter;
    	$company->link_youtube = $request->link_youtube;
    	$company->link_g = $request->link_g;
    	$company->link_vimeo = $request->link_vimeo;
        $company->introduce = $request->introduce;
        $company->resolve_complaints = $request->resolve_complaints;
        $company->rules = $request->rules;

    	$company->save();
    	return redirect('admin/company/edit/'.$id)->with('notify', 'Cập nhật thành công!');
    }
}
