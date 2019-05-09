<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Brand;
use App\Comment;
use App\Trademark;

class ProductController extends Controller
{
    public function getList(Request $request){
        if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $product = Product::where('products.name_pro', 'like' , '%' . $keyword . '%')
                 ->orderBy('id','DESC')
                ->paginate(10);
        }else{
            $product = Product::orderBy('id','DESC')->paginate(10);
        }
        return view('admin.product.list', ['product' => $product]);
    }

    public function getCreate(){
    	$product = Product::all();
        $cate = Category::all();
        $trade = Trademark::all();
    	return view('admin.product.create', compact('product', 'cate', 'trade'));
    }
    public function postCreate(Request $request){
    	$validatedData = $request->validate([
	        'name_pro' => 'required|min:2|unique:products',
	        'price_pro' => 'required',
            'quantity_pro' => 'required',
            'discount_pro' => 'required'
	    ], 
    		[
    			'name_pro.required'=>'Tên sản phẩm bắt buộc phải nhập !!!',
                'name_pro.unique'=>'Tên sản phẩm này đã tồn tại',
    			'name_pro.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
                
    			'price_pro.required'=>'Bạn chưa nhập giá !!!',
                
                'quantity_pro.required'=>'Bạn chưa nhập số lượng sản phẩm !!!',
                'discount_pro.required'=>'Bạn chưa nhập khuyến mại !!!'
    		]
	    );

	    $pro = new Product();
    	$pro->name_pro = $request->name_pro;
    	if($request->hasFile("thumbnail_pro")){
	    	$fileAnh = $request->File("thumbnail_pro");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/product/create')->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/product".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/product", $newName);
	    	$pro->thumbnail_pro = $newName;

	    }else{
	    	$pro->thumbnail_pro = "no-image.png";
	    }
    	
    	$pro->price_pro = $request->price_pro;
    	$pro->discount_pro = $request->discount_pro;
    	$pro->quantity_pro = $request->quantity_pro;
    	$pro->status_pro = $request->status_pro;
        $pro->outstanding = $request->outstanding;
        $pro->description_pro = $request->description_pro;
        $pro->idTrade = $request->trade;
        $pro->idCate = $request->category;
    
    	$pro->save();
    	return redirect('admin/product/create')->with('notify', 'Thêm mới thành công!');
    }

    public function getEdit($id){
        $product = Product::find($id);
        $cate = Category::all();
        $trade = Trademark::all();
        return view('admin.product.edit', compact('product', 'cate', 'trade'));
    }
    public function postEdit(Request $request, $id){
    	$validatedData = $request->validate([
            'name_pro' => 'required|min:2',
            'price_pro' => 'required|min:1|integer',
            'quantity_pro' => 'required|min:0|integer',
            'discount_pro' => 'required|min:0|integer'
        ], 
            [
                'name_pro.required'=>'Tên sản phẩm bắt buộc phải nhập !!!',
                'name_pro.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
                
                'price_pro.required'=>'Bạn chưa nhập giá !!!',
                'price_pro.min'=>'Giá phải lớn hơn 0 !!!',

                
                'quantity_pro.required'=>'Bạn chưa nhập số lượng sản phẩm !!!',
                'quantity_pro.min'=>'Số lượng không được âm !!!',

                'discount_pro.required'=>'Bạn chưa nhập khuyến mại !!!',
                'discount_pro.min'=>'Khuyến mại không được âm !!!'
            ]
        );
        /*if($request->price_pro < 0 || $request->price_pro = 0){
            alert('Giá phải lớn hơn 0');
        }*/

        $pro = Product::find($id);
        $pro->name_pro = $request->name_pro;
        if($request->hasFile("thumbnail_pro")){
            $fileAnh = $request->File("thumbnail_pro");

            $duoi = $fileAnh->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
                return redirect('admin/product/edit/'. $id)->with('loi', 'Ảnh không hợp lệ');
            }

            $name = $fileAnh->getClientOriginalName();
            $newName = str_random(5)."_".$name;
            while(file_exists("upload/product".$newName)){
                $newName = str_random(5)."_".$name;
            }
            $fileAnh->move("upload/product", $newName);
            //unlink("upload/product/". $pro->thumbnail_pro);
            $pro->thumbnail_pro = $newName;

        }
        
        $pro->price_pro = $request->price_pro;
        $pro->discount_pro = $request->discount_pro;
        $pro->quantity_pro = $request->quantity_pro;
        $pro->status_pro = $request->status_pro;
        $pro->outstanding = $request->outstanding;
        $pro->description_pro = $request->description_pro;
        $pro->idTrade = $request->trade;
        $pro->idCate = $request->category;
    
        $pro->save();
    	return redirect('admin/product/edit/'.$id)->with('notify', 'Cập nhật thành công!');
    }

    public function getDelete($id){
    	$pro = Product::find($id);

    	$pro->delete();
		return redirect('admin/product/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
