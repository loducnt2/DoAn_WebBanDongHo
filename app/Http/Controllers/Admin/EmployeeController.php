<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Employee;

class EmployeeController extends Controller
{
    public function getList(Request $request){
        if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $emp = DB::table('employees')->where('employees.name_emp', 'like' , '%' . $keyword . '%')
                        ->orWhere('employees.email_emp', 'like' , '%' . $keyword . '%')
                        ->paginate(15);
        }else{
           $emp = DB::table('employees')->paginate(15);
        }
        
        return view('admin.employee.list', ['emp' => $emp]);
    }

    public function getCreate(){
    	return view('admin.employee.create');
    }
    public function postCreate(Request $request){
    	$validatedData = $request->validate([
	        'name_emp' => 'required|min:2|max:255',
	        'email_emp' => 'required|unique:employees',
	        'phone_emp' => 'required|regex:/^(0)[0-9]{9}$/',
	        'address_emp' => 'required|min:2'
	    ], 
    		[
    			'name_emp.required'=>'Tên đămg nhập bắt buộc phải nhập !!!',
    			'name_emp.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name_emp.max'=>'Tên từ 2 - 100 ký tự nhé !!!',

    			'email_emp.required'=>'Bạn chưa nhập email !!!',
    			'email_emp.unique'=>'Email này đã tồn tại !!!',

    			'phone_emp.required'=>'Bạn chưa nhập số điện thoại !!!',
    			'phone_emp.regex'=>'SĐT không đúng định dạng !!!',

    			'address_emp.required'=>'Bạn chưa nhập địa chỉ !!!',
    			'address_emp.min'=>'Địa chỉ từ 2 ký tự trở lên !!!'
    		]
	    );

	    $emp = new Employee();
    	$emp->id = $request->id;
    	$emp->name_emp = $request->name_emp;
    	if($request->hasFile("avatar_emp")){
	    	$fileAnh = $request->File("avatar_emp");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/employee/create')->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/employee".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/employee", $newName);
	    	$emp->avatar_emp = $newName;

	    	/*echo "$avatar";*/
	    }else{
	    	$emp->avatar_emp = "no-image.png";
	    }

    	$emp->email_emp = $request->email_emp;
    	$emp->last_name_emp = $request->last_name_emp;
    	$emp->first_name_emp = $request->first_name_emp;
    	$emp->phone_emp = $request->phone_emp;
    	$emp->address_emp = $request->address_emp;
    	$emp->gender_emp = $request->gender_emp;
    
    	$emp->save();
    	return redirect('admin/employee/create')->with('notify', 'Thêm mới thành công!');
    }

    public function getEdit($id){;
    	$emp = Employee::find($id);
    	return view('admin.employee.edit', compact('emp'));
    }
    public function postEdit(Request $request, $id){
    	$validatedData = $request->validate([
	        'name_emp' => 'required|min:2|max:255',
	        'phone_emp' => 'required|regex:/^(0)[0-9]{9}$/',
	        'address_emp' => 'required|min:2',
	        'avatar_emp' => 'unique:employees',
	    ], 
    		[
    			'name_emp.required'=>'Tên đămg nhập bắt buộc phải nhập !!!',
    			'name_emp.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name_emp.max'=>'Tên từ 2 - 100 ký tự nhé !!!',

    			'phone_emp.required'=>'Bạn chưa nhập số điện thoại !!!',
    			'phone_emp.regex'=>'SĐT không đúng định dạng !!!',

    			'address_emp.required'=>'Bạn chưa nhập địa chỉ !!!',
    			'address_emp.min'=>'Địa chỉ từ 2 ký tự trở lên !!!', 

    			'avatar_emp.unique'=>'Tên ảnh này đã tồn tại !!!'
    		]
	    );

	    $emp = Employee::find($id);
    	$emp->id = $request->id;
    	$emp->name_emp = $request->name_emp;
    	if($request->hasFile("avatar_emp")){
	    	$fileAnh = $request->File("avatar_emp");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/employee/edit/' .$id)->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/employee".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/employee", $newName);
            unlink("upload/employee/". $emp->avatar_emp);
	    	$emp->avatar_emp = $newName;
	    }

    	$emp->last_name_emp = $request->last_name_emp;
    	$emp->first_name_emp = $request->first_name_emp;
    	$emp->phone_emp = $request->phone_emp;
    	$emp->address_emp = $request->address_emp;
    	$emp->gender_emp = $request->gender_emp;
    
    	$emp->save();
    	return redirect('admin/employee/edit/'.$id)->with('notify', 'Cập nhật thành công!');
    }

    public function getDelete($id){
    	$emp = Employee::find($id);

    	$emp->delete();
		return redirect('admin/employee/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
