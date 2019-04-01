<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trademark;
use App\Category;
use Illuminate\Support\Facades\DB;

class TradeController extends Controller
{
    public function getList(Request $request){
        if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $trade = Trademark::where('trademarks.name_trade', 'like' , '%' . $keyword . '%')->paginate(15);
        }else{
           $trade = Trademark::paginate(10);
        }
    	return view('admin.trade.list', ['trade' => $trade]);
    }

    public function getCreate(){
    	$cate = Category::all();
    	return view('admin.trade.create', compact('cate'));
    }
    public function postCreate(Request $request){
    	$validatedData = $request->validate([
	        'name_trade' => 'required|min:2|max:255'
	    ], 
    		[
    			'name_trade.required'=>'Tên bắt buộc phải nhập !!!',
    			'name_trade.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name_trade.max'=>'Tên từ 2 - 100 ký tự nhé !!!'
    		]
	    );

	    $trade = new Trademark();
    	$trade->name_trade = $request->name_trade;
    	
    	if($request->hasFile("avt_trade")){
	    	$fileAnh = $request->File("avt_trade");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/trade/create')->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/trade".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/trade", $newName);
	    	$trade->avt_trade = $newName;

	    }else{
	    	$trade->avt_trade = "";
	    }

    	$trade->address_trade = $request->address_trade;
    	$trade->description_trade = $request->description_trade;
    	$trade->idCategory = $request->category;

    	$trade->save();
    	return redirect('admin/trade/create')->with('notify', 'Thêm mới thành công!');
    }

    public function getEdit($id){
    	$cate = Category::all();
    	$trade = Trademark::find($id);
    	return view('admin.trade.edit', compact('cate','trade'));
    }
    public function postEdit(Request $request, $id){
    	$validatedData = $request->validate([
	        'name_trade' => 'required|min:2|max:255'
	    ], 
    		[
    			'name_trade.required'=>'Tên bắt buộc phải nhập !!!',
    			'name_trade.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
    			'name_trade.max'=>'Tên từ 2 - 100 ký tự nhé !!!',
    		]
	    );

    	$trade = Trademark::find($id);
    	$trade->name_trade = $request->name_trade;
    	
    	if($request->hasFile("avt_trade")){
	    	$fileAnh = $request->File("avt_trade");

	    	$duoi = $fileAnh->getClientOriginalExtension();
	    	if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
	    		return redirect('admin/trade/create')->with('loi', 'Ảnh không hợp lệ');
	    	}

	    	$name = $fileAnh->getClientOriginalName();
	    	$newName = str_random(5)."_".$name;
	    	while(file_exists("upload/trade".$newName)){
	    		$newName = str_random(5)."_".$name;
	    	}
	    	$fileAnh->move("upload/trade", $newName);
            //unlink("upload/trade/" .$trade->avt_trade);
	    	$trade->avt_trade = $newName;
	    }

    	$trade->address_trade = $request->address_trade;
    	$trade->description_trade = $request->description_trade;
    	$trade->idCategory = $request->category;

    	$trade->save();
    	return redirect('admin/trade/edit/'.$id)->with('notify', 'Bạn đã cập nhật thành công!');
    }

    public function getDelete($id){
    	$trade = Trademark::find($id);

        $order = DB::delete('delete from products where products.idTrade = ' .$id);

    	$trade->delete();
		return redirect('admin/trade/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
