<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Typeuser;
use Illuminate\Support\Facades\DB;

class TypeUserController extends Controller
{
    public function getList(Request $request){
        if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $type = Typeuser::where('typeusers.name_type', 'like' , '%' . $keyword . '%')->paginate(15);
        }else{
           $type = Typeuser::paginate(15);
        }
    	return view('admin.typeuser.list', ['type' => $type]);
    }

    public function getCreate(){
    	return view('admin.typeuser.create');
    }
    public function postCreate(Request $request){
    	$validatedData = $request->validate([
	        'name_type' => 'required|unique:typeusers|min:2|max:255'
	    ], 
    		[
    			'name_type.required'=>'Tên bắt buộc phải nhập !!!',
    			'name_type.unique'=>'Tên này đã tồn tại !!!',
    			'name_type.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name_type.max'=>'Tên từ 2 - 100 ký tự nhé !!!',
    		]
	    );

	    $type = new Typeuser();
    	$type->id = $request->id;
    	$type->name_type = $request->name_type;

    	$type->save();
    	return redirect('admin/typeuser/create')->with('notify', 'Thêm mới thành công!');
    }

    public function getEdit($id){
    	$type = Typeuser::find($id);
    	return view('admin.typeuser.edit', compact('type'));
    }
    public function postEdit(Request $request, $id){
    	$validatedData = $request->validate([
	        'name_type' => 'required|unique:typeusers|min:2|max:255'
	    ], 
    		[
    			'name_type.required'=>'Tên bắt buộc phải nhập !!!',
    			'name_type.unique'=>'Tên này đã tồn tại !!!',
    			'name_type.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name_type.max'=>'Tên từ 2 - 100 ký tự nhé !!!',
    		]
	    );

    	$type = Typeuser::find($id);
	   	$type->name_type = $request->name_type;
    	$type->save();
    	return redirect('admin/typeuser/edit/'.$id)->with('notify', 'Bạn đã cập nhật thành công!');
    }

    public function getDelete($id){
    	$type = Typeuser::find($id);

        $user = DB::delete('delete from users where users.idTypeUser = ' .$id);

    	$type->delete();
		return redirect('admin/typeuser/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
    
}
