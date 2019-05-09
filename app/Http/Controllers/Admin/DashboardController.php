<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Order;
use App\Employee;
use App\Product;
use App\Brand;
use App\Category;
use App\Newsletter;
use App\Post;
use App\Contact;
use App\Trademark;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userCount = User::count();
        $orderCount = Order::count();
        $empCount = Employee::count();
        $proCount = Product::count();
        $tradeCount = Trademark::count();
        $newsletterCount = Newsletter::count();
        $postCount = Post::count();
        $contactCount = Contact::count();

        if ($request->has('keyword')){
            $keyword = $request->get('keyword');
            $order = Order::where('orders.id', 'like' , '%' . $keyword . '%')->paginate(15);
        }else{
           $order = Order::orderBy('id','DESC')->paginate(15);
        }

        return view('admin.dashboard', compact('userCount', 'orderCount', 'proCount', 'empCount', 'tradeCount', 'order', 'newsletterCount', 'postCount', 'contactCount'));
    }
}
