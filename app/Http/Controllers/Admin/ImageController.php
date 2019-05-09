<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Image;
use App\Product;

class ImageController extends Controller
{
    public function getList(Request $request){
        $image = Image::paginate(10);
    	return view('admin.image.list', ['image' => $image]);
    }

    public function getCreate(){
    	$product = Product::all();
        $image = Image::all();
    	return view('admin.image.create', compact('product', 'image'));
    }
    public function postCreate(Request $request){
    	$validatedData = $request->validate([
	        'img' => 'required',
	    ], 
    		[
    			'img.required'=>'Bạn chưa chọn ảnh'
    		]
	    );

	    $img = new Image();
        $img->idProduct = $request->product;
    	if($request->hasFile("img")){
	    	$fileAnh = $request->File("img");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/image/create')->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/image".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/image", $newName);
	    	$img->img = $newName;

	    }else{
	    	$img->img = "no-image.png";
	    }
    
    	$img->save();
    	return redirect('admin/image/create')->with('notify', 'Thêm mới thành công!');
    }

    public function getEdit($id){
        $product = Product::all();
        $image = Image::find($id);
        return view('admin.image.edit', compact('product', 'image'));
    }
    public function postEdit(Request $request, $id){
    	$validatedData = $request->validate([
	        'img' => 'required',
	    ], 
    		[
    			'img.required'=>'Bạn chưa chọn ảnh'
    		]
	    );

	    $img = Image::find($id);
        $img->idProduct = $request->product;
    	if($request->hasFile("img")){
	    	$fileAnh = $request->File("img");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/image/create')->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/image".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/image", $newName);
            //unlink("upload/image/". $img->img);
	    	$img->img = $newName;
	    }
    
    	$img->save();
    	return redirect('admin/image/edit/'.$id)->with('notify', 'Cập nhật thành công!');
    }

    public function getDelete($id){
    	$img = Image::find($id);

    	$img->delete();
		return redirect('admin/image/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
