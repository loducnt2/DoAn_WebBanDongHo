<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Product;
use App\User;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
   /* public function getList(Request $request){
    	$product = Product::all();
    	$user = User::all();
    	if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $cmt = Comment::where('comments.idProduct', 'like' , '%' . $keyword . '%')
                        ->orWhere('comments.idUser', 'like' , '%' . $keyword . '%')
                        ->paginate(15);
        }else{
           $cmt = Comment::paginate(15);
        }
    	return view('admin.comment.list', compact('cmt', 'product', 'user'));
    }*/
    public function getDelete($id, $idPro){
        $con = Comment::find($id);

        $con->delete();
        return redirect('admin/product/edit/' .$idPro)->with('notifyDelete', 'Bạn đã xóa bình luận thành công!');
    }
}
