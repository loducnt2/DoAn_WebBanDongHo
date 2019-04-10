<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Newsletter;
use Mail;

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

    public function getSendMail(){
        return view('admin.newsletter.sendmail');
    }
    public function postSendMail(Request $request){
        $new = Newsletter::all();

        $validatedData = $request->validate([
            'contents_mail' => 'required'
        ], 
            [
                'contents_mail.required'=>'Bạn chưa nhập nội dung !!!'
            ]
        );

        foreach ($new as $key => $value) {
            $data = ['msg' => $request->contents_mail];
            Mail::send('admin.newsletter.contents', $data, function($message) use ($value){
                $message->from('anhlotest@gmail.com', 'Cudlo Shop');
                $message->to($value['email'], $value['email'])->subject('Đây là mail các tin tức mới nhất từ Cudlo Shop');
            });
        }
        return redirect('admin/newsletter/list')->with('success', 'Bạn đã gửi thư thành công!');
    }

    public function getDelete($id){
    	$news = Newsletter::find($id);

    	$news->delete();
		return redirect('admin/newsletter/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
