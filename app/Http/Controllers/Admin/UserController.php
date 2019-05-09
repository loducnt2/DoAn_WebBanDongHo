<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Typeuser;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getLoginAdmin(){
        return view('admin.login');
    }
    public function postLoginAdmin(Request $request){
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ], 
            [
                'email.required'=>'Bạn chưa nhập email !!!',
                'password.required'=>'Bạn chưa nhập mật khẩu !!!',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự !!!'
            ]
        );

        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            return redirect('admin/adminpage');
        }
        if (Auth::attempt(['name'=>$request->email, 'password'=>$request->password])) {
            return redirect('admin/adminpage');
        }else{
            return redirect('admin/login')->with('notify', 'Đăng nhập không thành công, sai tài khoản hoặc mật khẩu!');
        }
    }
    public function getLogoutAdmin(){
        Auth::logout();

        return redirect('admin/login');
    }
     /*- - - - - - - - - -  - - - - - - - - - - - */
    public function getList(Request $request){
        /*if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $user = User::where('users.name', 'like' , '%' . $keyword . '%')->paginate(15);
        }else{
           $user = User::paginate(15);
        }*/

        if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $user = User::where('name', 'like' , '%' . $keyword . '%')->orWhere('email', 'like' , '%' . $keyword . '%')->paginate(15);
        }else{
           $user = User::paginate(15);
        }

    	return view('admin.user.list', ['user' => $user]);
    }

    public function getCreate(){
    	$type = Typeuser::all();
    	return view('admin.user.create', compact('type'));
    }
    public function postCreate(Request $request){
    	$validatedData = $request->validate([
	        'name' => 'required|min:2|unique:users',
	        'email' => 'required|unique:users',
	        'password' => 'required|min:6',
	        'passwordAgain' => 'required|same:password',
            'phone' => 'required|regex:/^(0)[0-9]{9}$/',
            'address' => 'required|min:2'
	    ], 
    		[
    			'name.required'=>'Tên đămg nhập bắt buộc phải nhập !!!',
    			'name.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name.unique'=>'Tên này đã có người sử dụng, mời bạn chọn tên mới!',
                
    			'email.required'=>'Bạn chưa nhập email !!!',
    			'email.unique'=>'Email này đã tồn tại !!!',

                'password.required'=>'Bạn chưa nhập mật khẩu !!!',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự !!!',
                
                'passwordAgain.required'=>'Bạn chưa nhập mật khẩu xác nhận !!!',
    			'passwordAgain.same'=>'Mật khẩu xác nhận chưa đúng !!!',

                'phone.required'=>'Bạn chưa nhập số điện thoại !!!',
                'phone.regex'=>'SĐT không đúng định dạng !!!',

                'address.required'=>'Bạn chưa nhập địa chỉ !!!',
                'address.min'=>'Địa chỉ từ 2 ký tự trở lên !!!'
    		]
	    );

	    $user = new User();
    	$user->id = $request->id;
    	$user->name = $request->name;
    	if($request->hasFile("avatar")){
	    	$fileAnh = $request->File("avatar");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/user/create')->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/user".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/user", $newName);
	    	$user->avatar = $newName;

	    	/*echo "$avatar";*/
	    }else{
	    	$user->avatar = "no-image.png";
	    }

    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->last_name = $request->last_name;
    	$user->first_name = $request->first_name;
    	$user->phone = $request->phone;
    	$user->address = $request->address;
    	$user->idTypeUser = $request->typeuser;
    	$user->gender = $request->gender;
    
    	$user->save();
    	return redirect('admin/user/create')->with('notify', 'Thêm mới thành công!');
    }

    public function getEdit($id){
    	$type = Typeuser::all();
    	$user = User::find($id);
    	return view('admin.user.edit', compact('type', 'user'));
    }
    public function postEdit(Request $request, $id){
    	$validatedData = $request->validate([
	        'phone' => 'required|regex:/^(0)[0-9]{9}$/',
	        'address' => 'required|min:2',
	        'avatar' => 'unique:users',
	    ], 
    		[
    			'phone.required'=>'Bạn chưa nhập số điện thoại !!!',
    			'phone.regex'=>'SĐT không đúng định dạng !!!',

    			'address.required'=>'Bạn chưa nhập địa chỉ !!!',
    			'address.min'=>'Địa chỉ từ 2 ký tự trở lên !!!', 

    			'avatar.unique'=>'Tên ảnh này đã tồn tại !!!'
    		]
	    );

	    $user = User::find($id);

    	if($request->hasFile("avatar")){
	    	$fileAnh = $request->File("avatar");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/user/edit/'. $id)->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/user".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/user", $newName);
	    	$user->avatar = $newName;
	    }

    	if($request->changePassword == "on"){
    		$validatedData = $request->validate([
	        'password' => 'required|min:6',
	        'passwordAgain' => 'required|same:password'

		    ], 
	    		[
	    			'password.required'=>'Bạn chưa nhập mật khẩu !!!',
	                'password.min'=>'Mật khẩu ít nhất 6 ký tự !!!',
	                
	                'passwordAgain.required'=>'Bạn chưa nhập mật khẩu xác nhận !!!',
	    			'passwordAgain.same'=>'Mật khẩu xác nhận chưa đúng !!!'
	    		]
		    ); 
    		$user->password = bcrypt($request->password);
    	}

    	$user->last_name = $request->last_name;
    	$user->first_name = $request->first_name;
    	$user->phone = $request->phone;
    	$user->address = $request->address;
    	$user->gender = $request->gender;

        if(Auth::user()->idTypeUser == 1){
            $user->idTypeUser = $request->typeuser;
        }
    
    	$user->save();
    	return redirect('admin/user/edit/'.$id)->with('notify', 'Cập nhật thành công!');
    }

    public function getDelete($id){
    	$type = User::find($id);

    	$type->delete();
		return redirect('admin/user/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
