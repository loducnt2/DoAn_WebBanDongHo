<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Newsletter;

class NewsletterController extends Controller
{
    public function getList(Request $request){
    	if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $news = Newsletter::where('newsletters.email', 'like' , '%' . $keyword . '%')->paginate(15);
        }else{
           $news = Newsletter::paginate(15);
        }
    	return view('admin.newsletter.list', ['news' => $news]);
    }
    public function getDelete($id){
    	$news = Newsletter::find($id);

    	$news->delete();
		return redirect('admin/newsletter/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
