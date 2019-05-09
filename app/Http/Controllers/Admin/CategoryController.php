<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Trademark;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function getList(Request $request){
        if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $cate = Category::where('categories.name_cate', 'like' , '%' . $keyword . '%')->paginate(15);
        }else{
           $cate = Category::paginate(15);
        }
    	return view('admin.category.list', ['cate' => $cate]);
    }

    public function getCreate(){
    	return view('admin.category.create');
    }
    public function postCreate(Request $request){
    	$validatedData = $request->validate([
	        'name_cate' => 'required|unique:categories|min:2|max:255'
	    ], 
    		[
    			'name_cate.required'=>'Tên bắt buộc phải nhập !!!',
    			'name_cate.unique'=>'Tên này đã tồn tại !!!',
    			'name_cate.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name_cate.max'=>'Tên từ 2 - 100 ký tự nhé !!!',
    		]
	    );

	    $cate = new Category();
    	$cate->id = $request->id;
    	$cate->name_cate = $request->name_cate;

    	$cate->save();
    	return redirect('admin/category/create')->with('notify', 'Thêm mới thành công!');
    }

    public function getEdit($id){
    	$cate = Category::find($id);
    	return view('admin.category.edit', compact('cate'));
    }
    public function postEdit(Request $request, $id){
    	$validatedData = $request->validate([
	        'name_cate' => 'required|unique:categories|min:2|max:255'
	    ], 
    		[
    			'name_cate.required'=>'Tên bắt buộc phải nhập !!!',
    			'name_cate.unique'=>'Tên này đã tồn tại !!!',
    			'name_cate.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name_cate.max'=>'Tên từ 2 - 100 ký tự nhé !!!',
    		]
	    );

    	$cate = Category::find($id);
	   	$cate->name_cate = $request->name_cate;
    	$cate->save();
    	return redirect('admin/category/edit/'.$id)->with('notify', 'Bạn đã cập nhật thành công!');
    }

    public function getDelete($id){
    	$cate = Category::find($id);

        $order = DB::delete('delete from products where products.idCate = '.$id);
    	$cate->delete();

		return redirect('admin/category/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
