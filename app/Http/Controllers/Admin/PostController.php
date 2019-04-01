<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    public function getList(Request $request){
        if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $posts = Post::where('news.title', 'like' , '%' . $keyword . '%')->paginate(15);
        }else{
           $posts = Post::paginate(10);
        }
    	return view('admin.post.list', ['posts' => $posts]);
    }

    public function getCreate(){
    	return view('admin.post.create');
    }
    public function postCreate(Request $request){
    	$validatedData = $request->validate([
	        'title' => 'required',
	        'contents' => 'required'
	    ], 
    		[
    			'title.required'=>'Tên bắt buộc phải nhập !!!',
    			'contents.required'=>'Nội dung bắt buộc nhập !!!'
    		]
	    );

	    $post = new Post();
    	$post->title = $request->title;
    	$post->unsign_title = changeTitle($request->title);
    	/*echo changeTitle($request->title);
    	die();*/
    	
    	if($request->hasFile("thumbnail")){
	    	$fileAnh = $request->File("thumbnail");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/post/create')->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/post".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/post", $newName);
	    	$post->thumbnail = $newName;

	    }else{
	    	$post->thumbnail = "no-image.png";
	    }

    	$post->contents = $request->contents;

    	$post->save();
    	return redirect('admin/post/create')->with('notify', 'Thêm mới thành công!');
    }

    public function getEdit($id){
    	$post = Post::find($id);
    	return view('admin.post.edit', compact('post'));
    }
    public function postEdit(Request $request, $id){
    	$validatedData = $request->validate([
	        'title' => 'required',
	        'contents' => 'required'
	    ], 
    		[
    			'title.required'=>'Tên bắt buộc phải nhập !!!',
    			'contents.required'=>'Nội dung bắt buộc nhập !!!'
    		]
	    );

    	$post = Post::find($id);
    	$post->title = $request->title;
    	$post->unsign_title = changeTitle($request->title);
    	/*echo changeTitle($request->title);
    	die();*/
    	
    	if($request->hasFile("thumbnail")){
	    	$fileAnh = $request->File("thumbnail");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/post/create')->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/post".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/post", $newName);
	    	$post->thumbnail = $newName;
	    }

    	$post->contents = $request->contents;

    	$post->save();
    	return redirect('admin/post/edit/'.$id)->with('notify', 'Bạn đã cập nhật thành công!');
    }

    public function getDelete($id){
    	$brand = Brand::find($id);

    	$brand->delete();
		return redirect('admin/brand/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
