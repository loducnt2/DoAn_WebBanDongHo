<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Order;

class pdfController extends Controller
{
    public function finish()
    {
        $order = Order::where('status_order', '=', 0)
                ->orderBy('id','DESC')->paginate(15);

    	$pdf = PDF::loadView('order_pdf',  compact('order'));
    		return $pdf->download('order_pdf.pdf');
    }
    public function processing()
    {
        $order = Order::where('status_order', '=', 1)
                ->orderBy('id','DESC')->paginate(15);

        $pdf = PDF::loadView('order_pdf',  compact('order'));
            return $pdf->download('order_pdf.pdf');
    }
    public function sending()
    {
        $order = Order::where('status_order', '=', 2)
                ->orderBy('id','DESC')->paginate(15);

        $pdf = PDF::loadView('order_pdf',  compact('order'));
            return $pdf->download('order_pdf.pdf');
    }
    public function cancel()
    {
        $order = Order::where('status_order', '=', 3)
                ->orderBy('id','DESC')->paginate(15);

        $pdf = PDF::loadView('order_pdf',  compact('order'));
            return $pdf->download('order_pdf.pdf');
    }

    public function print(){
        $date1 = Session('new_date_1');
        $date2 = Session('new_date_2');

        if($date1 != ''){
            if($date2 != ''){
                // Tính từ date1 -> date2
                $order = Order::where('created_at', '>=', $date1)
                ->where('created_at', '<=', $date2)
                ->where('status_order', '=', 0)
                ->get();
            }else{
                // Đúng ngày đó
                $order = Order::whereDate('created_at', $date1)
                ->where('status_order', '=', 0)
                ->get();
            }
        }else{
            return redirect('admin/order/list')->with('notifyDate', 'Bạn cần nhập vào ngày bắt đầu!');
        }
        $pdf = PDF::loadView('order_pdf',  compact('order', 'date1', 'date2'));
    		return $pdf->download('order_pdf.pdf');
    }
}
