<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use Illuminate\Support\Facades\DB;
use Mail;

class ContactController extends Controller
{
    public function getList(Request $request){
        if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $con = DB::table('contacts')
                    ->where('contacts.name_con', 'like' , '%' . $keyword . '%')
                    ->orderBy('id','DESC')
                    ->paginate(15);
        }else{
           $con = Contact::orderBy('id','DESC')->paginate(15);
        }
    	return view('admin.contact.list', ['con' => $con]);
    }

    public function getRep($id){
    	$con = Contact::find($id);
        return view('admin.contact.repcontact', compact('con'));
    }
    public function postRep(Request $request, $id){

        $con = Contact::find($id);

        $validatedData = $request->validate([
            'rep_con' => 'required'
        ], 
            [
                'rep_con.required'=>'Tên bắt buộc phải nhập !!!'
            ]
        );

        $data = ['msg' => $request->rep_con];
        Mail::send('admin.contact.contents', $data, function($message) use ($con){
            $message->from('anhlotest@gmail.com', 'Cudlo Shop');
            $message->to($con->email_con, $con->name_con)->subject('Đây là mail từ Cudlo shop');
        });

        $con->rep_con = $request->rep_con;
        $con->status_con = 2;
        $con->save();

        return redirect('admin/contact/list')->with('notify', 'Bạn đã trả lời liên hệ thành công!');
    }

    public function getDelete($id){
    	$con = Contact::find($id);

    	$con->delete();
		return redirect('admin/contact/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
