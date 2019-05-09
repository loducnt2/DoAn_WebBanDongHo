<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Employee;
use App\Orderdetail;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function getList(Request $request){
        /*if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $order = Order::where('orders.id', 'like' , '%' . $keyword . '%')->paginate(15);
        }else{
           $order = Order::orderBy('id','DESC')->paginate(15);
        }*/
        $order = Order::orderBy('id','DESC')->paginate(15);
        return view('admin.order.list', ['order' => $order]);
    }
    public function getOrderFinish(){
        $order = Order::where('status_order', '=', 0)
                ->orderBy('id','DESC')->paginate(15);
        return view('admin.order.status_order', ['order' => $order]);
    }
    public function getOrderProcessing(){
        $order = Order::where('status_order', '=', 1)
                ->orderBy('id','DESC')->paginate(15);
        return view('admin.order.status_order', ['order' => $order]);
    }
    public function getOrderSending(){
        $order = Order::where('status_order', '=', 2)
                ->orderBy('id','DESC')->paginate(15);
        return view('admin.order.status_order', ['order' => $order]);
    }
    public function getOrderCancel(){
        $order = Order::where('status_order', '=', 3)
                ->orderBy('id','DESC')->paginate(15);
        return view('admin.order.status_order', ['order' => $order]);
    }

    public function postFilter(Request $request){
        $dulieu_tu_input = $request->all();
        /*var_dump($dulieu_tu_input);
        die();*/
        $date1 = $dulieu_tu_input["date1"];
        $date2 = $dulieu_tu_input["date2"];

        $request->session()->put('new_date_1', $date1);
        $request->session()->put('new_date_2', $date2);

        if($dulieu_tu_input["date1"] != ''){
            if($dulieu_tu_input["date2"] != ''){
                // Tính từ date1 -> date2
                $order = Order::where('created_at', '>=', $dulieu_tu_input["date1"])
                ->where('created_at', '<=', $dulieu_tu_input["date2"])
                ->where('status_order', '=', 0)
                ->get();
            }else{
                // Đúng ngày đó
                $order = Order::whereDate('created_at', $dulieu_tu_input["date1"])
                ->where('status_order', '=', 0)
                ->get();
            }
        }else{
            return redirect('admin/order/list')->with('notifyDate', 'Bạn cần nhập vào ngày bắt đầu!');
        }
        return view('admin.order.filter', compact('order', 'date1', 'date2'));

        /*$pdf = PDF::loadView('order_pdf',  compact('order', 'date1', 'date2'));
            return $pdf->download('order_pdf.pdf');*/
    }

    public function getDetail($id){
        /*$detail = "SELECT orderdetails.id, orderdetails.idOrder, orderdetails.idProduct, orderdetails.quantity, orderdetails.created_at, orderdetails.updated_at
             FROM orderdetails
             INNER JOIN orders
             ON orderdetails.idOrder = orders.id
             WHERE orders.id = " .$id;*/

        $detail = Orderdetail::select('orderdetails.id', 'orderdetails.idOrder', 'orderdetails.idProduct', 'orderdetails.quantity', 'orderdetails.created_at', 'orderdetails.updated_at')
        ->join('orders', 'orders.id', '=', 'orderdetails.idOrder')
        ->where('orders.id', $id)
        ->get();

        /*echo "<pre>";
        print_r($detail->toArray());
        die();
*/
        return view('admin.order.detail', compact('detail'));
    }

    public function getEdit($id){
    	$order = Order::find($id);
    	$emp = Employee::all();
    	return view('admin.order.edit', compact('order', 'emp'));
    }
    public function postEdit(Request $request, $id){
    	$order = Order::find($id);
        if ($order->status_order != 0 && $order->status_order != 0) {
            $order->idEmployee = $request->employee;
            $order->status_order = $request->status_order;
        }

	   	$order->note_order = $request->note_order;
        $order->updated_at = date('Y-m-d H:i:s');
    	$order->save();
    	return redirect('admin/order/edit/'.$id)->with('notify', 'Bạn đã cập nhật thành công!');
    }

    public function getDelete($id){
    	$order = Order::find($id);

        $orderDetail = DB::delete('delete from orderdetails where orderdetails.idOrder = ' .$id);

    	$order->delete();
		return redirect('admin/order/list')->with('notifyDelete', 'Bạn đã xóa thành công!');
    }
}
