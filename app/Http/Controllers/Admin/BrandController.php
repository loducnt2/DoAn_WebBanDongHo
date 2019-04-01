<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;

class BrandController extends Controller
{
    public function getList(Request $request){
        if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $brand = Brand::where('brands.name_brand', 'like' , '%' . $keyword . '%')->paginate(15);
        }else{
           $brand = Brand::paginate(10);
        }
    	return view('admin.brand.list', ['brand' => $brand]);
    }

    public function getCreate(){
    	return view('admin.brand.create');
    }
    public function postCreate(Request $request){
    	$validatedData = $request->validate([
	        'name_brand' => 'required|unique:brands|min:2|max:255'
	    ], 
    		[
    			'name_brand.required'=>'Tên bắt buộc phải nhập !!!',
    			'name_brand.unique'=>'Tên này đã tồn tại !!!',
    			'name_brand.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name_brand.max'=>'Tên từ 2 - 100 ký tự nhé !!!',
    		]
	    );

	    $brand = new Brand();
    	$brand->name_brand = $request->name_brand;
    	
    	if($request->hasFile("avt_brand")){
	    	$fileAnh = $request->File("avt_brand");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/brand/create')->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/brand".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/brand", $newName);
	    	$brand->avt_brand = $newName;

	    }else{
	    	$brand->avt_brand = "no-image.png";
	    }

    	$brand->address_brand = $request->address_brand;
    	$brand->description_brand = $request->description_brand;

    	$brand->save();
    	return redirect('admin/brand/create')->with('notify', 'Thêm mới thành công!');
    }

    public function getEdit($id){
    	$brand = Brand::find($id);
    	return view('admin.brand.edit', compact('brand'));
    }
    public function postEdit(Request $request, $id){
    	$validatedData = $request->validate([
	        'name_brand' => 'required|min:2|max:255'
	    ], 
    		[
    			'name_brand.required'=>'Tên bắt buộc phải nhập !!!',
    			'name_brand.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name_brand.max'=>'Tên từ 2 - 100 ký tự nhé !!!',
    		]
	    );

    	$brand = Brand::find($id);
	   	$brand->name_brand = $request->name_brand;

	    if($request->hasFile("avt_brand")){
	    	$fileAnh = $request->File("avt_brand");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/brand/edit/'. $id)->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/brand".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/brand", $newName);
            unlink("upload/brand/". $brand->avt_brand);
	    	$brand->avt_brand = $newName;
	    }

    	$brand->address_brand = $request->address_brand;
    	$brand->description_brand = $request->description_brand;
    	$brand->save();

    	return redirect('admin/brand/edit/'.$id)->with('notify', 'Bạn đã cập nhật thành công!');
    }

    public function getDelete($id){
    	$brand = Brand::find($id);

    	$brand->delete();
		return redirect('admin/brand/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
