<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\Comment;
use App\Contact;
use App\Image;
use App\Trademark;
use App\User;
use App\Product;
use App\Company;
use App\Newsletter;
use App\Order;
use App\Orderdetail;
use App\Post;
use App\Customercare;
use App\ListComment;

use App\Province;
use App\District;
use App\Commune;

use Auth;
use View;
use Mail;

use Cart;
use Session;

class PagesController extends Controller
{	
	function __construct(){
		$trade = Trademark::take(10)->get();
        $tradeAll = Trademark::all();
		/*
    	 HOẶC
    	$brand = DB::table('brands')->take(2)->get();
    	*/
    	
        $cate = Category::all();
        $company = Company::all();
        $customerCare = Customercare::all();
        /*echo "<pre>";
        print_r($company->toArray());
        die();*/

    	View::share('trade', $trade);
    	View::share('cate', $cate);
        View::share('company', $company);
        View::share('tradeAll', $tradeAll);
        View::share('customerCare', $customerCare);

        /*Kiểm tra đăng nhập*/
        View::composer('*', function ($view) {
            $view->with('user_client', Auth::user());
        });

	} // Cần khai báo use View để dùng được View share;

    
    /* - - - - - -    FOOTER   - - - - -  - - -*/  
    public function getIntroduce(){
        return view('pages.introduce');
    }
    public function getIntroduce1(){
        return view('pages.introduce1');
    }

    public function getResolveComplaints(){
        return view('pages.resolve_complaints');
    }
    public function getRules(){
        return view('pages.rules');
    }
    public function getWarranty(){
        return view('pages.warranty_policy');
    }
    public function getReturnPolicy(){
        return view('pages.return_policy');
    }
    public function getInfoSecurity(){
        return view('pages.info_security_policy');
    }
    public function getPolicyForeigner(){
        return view('pages.policy_foreigner');
    }
    public function getDeliveryPolicy(){
        return view('pages.delivery_policy');
    }
    public function getPaymentGuide(){
        return view('pages.payment_guide');
    }
    public function getShoppingGuide(){
        return view('pages.shopping_guide');
    }


   /* - - - - - -    LARAVEL CART   - - - - -  - - -*/   
   public function index(){
        return view('cart.show');
   }
   
   public function store($id, Request $request){
        $product = Product::findOrFail($id);

       /* echo "<pre>";
        print_r($product->toArray());
        die();*/

        if ($product->id != null){
            Cart::add(
                [
                    'id' => $product->id,
                    'name' => $product->name_pro,
                    'qty' => 1,
                    'price' => $product->price_pro,
                    'options' => [
                        'thumbnail_pro' => $product->thumbnail_pro,
                        'discount_pro' => $product->discount_pro,
                        'quantity_pro' => $product->quantity_pro
                    ]
                ]
            );
            Session::flash('success', 'Thêm mới sản phẩm vào giỏ hàng thành công!!!');
        }else {
            Session::flash('error', 'Sản phẩm đã hết hàng!!!');
        }
        return redirect()->back();
   }

   public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->id != null){
            foreach (Cart::content() as $key => $item){
                if ($item->id == $product->id){
                    Cart::remove($key);
                    break;
                }
            }
        }
        return redirect()->back();
    }
    public function destroyAll(){
        Cart::destroy();
        return redirect()->back();
    }

    public function updateQty(Request $request){
        $qty = $request->SoLuongMoi;
        $id = $request->IdCart;

        if($qty < 1){
            die("Số lượng phải lớn hơn 0");
        }else{
            Cart::update($id, $qty);
            return redirect('cart');
        }   
    }


    public function getCheckout(){
        $province = Province::all();
        $district = District::all();
        $commune = Commune::all();
        return view('cart.checkout', compact('province', 'district', 'commune'));
    }
    public function postCheckout(Request $request){
        if(Cart::content()->count() <= 0) {
            Session::flash('error', 'Không có sản phẩm nào trong giỏ hàng - Không thể đặt hàng!!!');
            return redirect()->back();
        }
        if (!Auth::check()) {
            return redirect('cart/checkout')->with('error', 'Vui lòng đăng nhập để tiến hành đặt hàng !');
        }

        $validatedData = $request->validate([
            'delivery_phone' => 'required|regex:/^(0)[0-9]{9}$/'
        ], 
            [
                'delivery_phone.required'=>'Bạn chưa nhập số điên thoại nhận hàng !!!',
                'delivery_phone.regex'=>'SĐT không đúng định dạng !!!'
            ]
        );


        $totalAmount = 0; 
        foreach (Cart::content() as $key => $item){
            $Newdiscount = (100-$item->options->discount_pro)/100;
            $totalAmount += ($item->qty*$item->price*$Newdiscount);
            if( ($item->options->quantity_pro - $item->qty) < 0 ){
                Session::flash('error', 'Sản phẩm đã hết hàng, Vui lòng quay lại sau !');
                return redirect()->back();
                die();
            }
        }

        // LƯU THÔNG TU VÀO orders
            $order = new Order();
            
            $pro = Province::where('id', $request->province)->first();
            $dis = District::where('maqh', $request->district)->first();
            $com = Commune::where('xaid', $request->commune)->first();

    if($request->changeAddress == "on"){
        $validatedData = $request->validate([
        'house_number' => 'required'
        ], 
            [
                'house_number.required'=>'Bạn chưa nhập số nhà này !!!'
            ]
        ); 
        $order->delivery_address = $request->house_number." - " .$com->name ." - " .$dis->name ." - " .$pro->name;
    }else{
        $order->delivery_address = Auth::user()->address;
    }
            $order->delivery_phone = $request->delivery_phone;
            $order->note_order = $request->note_order;
            $order->total = $totalAmount;
            $order->status_order = 1;
            $order->idEmployee = 1;

            if(Auth::check()) {
                $order->idUser = Auth::user()->id;
            }
            $order->save();

            
            //LƯU THÔNG TIN VÀO orderdetail
           /* $totalAmount = 0;*/
            foreach (Cart::content() as $key => $item){
                $orderDetail = new Orderdetail();
                $orderDetail->idOrder = $order->id;
                $orderDetail->idProduct = $item->id;
                $orderDetail->quantity = $item->qty;
                $orderDetail->price = $item->price;
                $orderDetail->discount = $item->options->discount_pro;
                $orderDetail->save();
                /*$totalAmount += ($item->price * $item->qty);*/

                // GIẢM SỐ LƯỢNG SẢN PHẨM SAU KHI HÓA ĐƠN ĐƯỢC ĐẶT
                $product = Product::find($item->id); 
                $product->quantity_pro = $item->options->quantity_pro - $item->qty;
                $product->save();
            }
           /* $order->amount = $totalAmount;*/

            //xoa gio hang
        Cart::destroy();

        $id_cus = Auth::user()->id;
        return redirect('cart/order/'.$id_cus)->with('success', 'Bạn đã đặt hàng thành công!!!');
    }

    /// Show phần hủy đơn hàng
    public function getOrder($id){
        if(Auth::check()) {
            $id = Auth::user()->id;
            //$detail = Order::find($id)->orderdetail()->get();

            //$orders = Order::find($id);

            /*$detail = Orderdetail::select('orderdetails.id', 'orderdetails.idOrder', 'orderdetails.idProduct', 'orderdetails.quantity', 'orderdetails.price', 'orderdetails.discount', 'orderdetails.created_at', 'orderdetails.updated_at')
            ->join('orders', 'orders.id', '=', 'orderdetails.idOrder')
            ->where('orders.idUser', $id)
            ->where('orders.status_order', '<>', 0)
            ->where('orders.status_order', '<>', 3)
            ->get();*/

            $orders = Order::select('orders.id', 'orders.idUser', 'orders.delivery_phone', 'orders.delivery_address', 'orders.note_order', 'orders.total', 'orders.status_order','orders.created_at', 'orders.updated_at', 'users.name')
            ->join('users', 'users.id', '=', 'orders.idUser')
            ->where('orders.idUser', $id)
            ->where('orders.status_order', '<>', 0)
            ->where('orders.status_order', '<>', 3)
            ->get();

           /* echo "<pre>";
            print_r($orders->toArray());
            die();*/
            return view('cart.order', compact('detail', 'orders'));
        }else{
            die('Bạn chưa tạo hóa đơn nào');
        }
    }
    // Hủy đơn hàng
    public function postOrder($id){
        $id = Auth::user()->id;

        /*$order = DB::update('update orders set status_order = 3 where orders.status_order = 1 OR orders.status_order = 2 AND orders.idUser = '.$id);*/

        $order = DB::update('update products INNER JOIN orderdetails ON orderdetails.idProduct = products.id INNER JOIN orders ON orders.id = orderdetails.idOrder SET products.quantity_pro = products.quantity_pro + orderdetails.quantity, orders.status_order = 3 WHERE orders.status_order = 1 AND orders.idUser = '.$id);

        return redirect('home')->with('notifyDeleteOrder', 'Bạn đã hủy đơn hàng thành công!');
    }

   /* - - - - - -    END LARAVEL CART   - - - - -  - - -*/  
	public function getHome(){

        // 
		$product = Product::orderBy('id','DESC')->take(24)->get();

        // CÁC SP KHUYẾN MẠI
		$product_dis = Product::where('discount_pro', '>', 0)->orderBy('id','DESC')->take(24)->get();

        // CÁC SP BÁN CHẠY
        $products_hot_sell = Product::select('products.*')
            ->join('orderdetails', 'products.id', '=', 'orderdetails.idProduct')
            ->where('orderdetails.quantity','>', '1')
            ->take(24)
            ->get();

        // CÁC SẢN PHẨM NỔI BẬT
        $product_Noibat = Product::where('outstanding', '=', 1)->orderBy('id','DESC')->take(10)->get();

        /*$cate_home = Category::take(3)->get();
        $product_1 = Category::find(1)->product()->get();
        $product_3 = Category::find(3)->product()->get();
        $product_4 = Category::find(4)->product()->get();*/

        $trade_1 = Product::where('idTrade', '=', 1)->orderBy('id','DESC')->take(20)->get();
        $trade_2 = Product::where('idTrade', '=', 2)->orderBy('id','DESC')->take(20)->get();
        $trade_3 = Product::where('idTrade', '=', 3)->orderBy('id','DESC')->take(20)->get();

        // Sản phẩm mới ở banner giữa
        $new_product = Product::orderBy('id','DESC')->take(5)->get();

		/*echo "<pre>";
        print_r($trade_1->toArray());
        die();*/

    	return view('pages.home', compact('product', 'product_dis', 'product_Noibat', 'new_product', 'trade_1', 'trade_2', 'trade_3', 'products_hot_sell'));
    }
    public function postHome(Request $request){
        $validatedData = $request->validate([
            'email' => 'unique:newsletters'
        ], 
            [
                'email.unique'=>'Email này đã đăng ký nhận tin !!!'
            ]
        );
        $news = new Newsletter();
        $news->email = $request->email;

        $news->save();
        return redirect('home')->with('notifyNews', 'Bạn đã đăng ký nhận thông tin thành công!');

    }

    // PHẦN LIÊN HỆ
    public function getContact(){
    	return view('pages.contact');
    }
    public function postContact(Request $request){
        $validatedData = $request->validate([
            'phone_con' => 'regex:/^(0)[0-9]{9}$/'
        ], 
            [
                'phone_con.regex'=>'SĐT không đúng định dạng'
            ]
        );
        $con = new Contact();
        $con->name_con = $request->name_con;
        $con->email_con = $request->email_con;
        $con->phone_con = $request->phone_con;
        $con->message_con = $request->message_con;
        $con->status_con = "1";
        $con->save();
        return redirect('contact')->with('notify', 'Bạn đã gửi phản hồi thành công!');
    }

    
    public function getRegular(){
    	return view('pages.regular');
    }


    //  PHẦN  SẢN  PHẨM  -  Chi tiết sản phẩm
    public function getShop($id){
        $tra_shop = Trademark::find($id);

        // DS sản phẩm theo từng thương hiệu
        $pro_shop = Product::where('idTrade', $id)->paginate(20);

        /*PHẦN  HIỆN  RA CÁC SẢN PHẨM LIÊN QUAN */
        $product_Noibat = Product::where('outstanding', '=', 1)->orderBy('id','DESC')->take(10)->get();
        $tra_relative_shop = Trademark::all();

    	return view('pages.shop', compact('tra_shop', 'pro_shop', 'product_Noibat', 'tra_relative_shop'));
    }
    public function getProduct($id){
        $pro_pro = Product::find($id);
        $img_pro = Image::where('idProduct', $id)->orderBy('id','DESC')->take(3)->get();

        $trade_id = $pro_pro->trade->id;


            /*PHẦN  HIỆN  RA CÁC SẢN PHẨM LIÊN QUAN - cùng thương hiệu */
        $relative_pro = Product::select('products.*')
            ->join('trademarks', 'products.idTrade', '=', 'trademarks.id')
            ->where('trademarks.id', $trade_id)
            ->where('products.id', '!=', $id)
            ->get();

         /* CÁC SẢN PHẨM CÙNG KHOẢNG GIÁ */
         $totalAmount = 0; 
         $new_price = $pro_pro->price_pro;
         $new_dis = $pro_pro->discount_pro;
        $Newdiscount = (100-$new_dis)/100;
        $totalAmount += ($new_price*$Newdiscount);
        $same_price_pro = Product::select('products.id', 'products.name_pro', 'products.thumbnail_pro', 'products.price_pro', 'products.discount_pro', 'products.quantity_pro', 'products.status_pro', 'products.outstanding', 'products.description_pro', 'products.idTrade','products.created_at', 'products.updated_at')
            ->whereBetween('products.price_pro', array($new_price - 500000, $new_price + 500000))
         ->get();

        /*echo "<pre>";
        print_r($same_price_pro->toArray());
        die();*/

        return view('pages.product', compact('pro_pro', 'relative_pro', 'img_pro', 'same_price_pro', 'trade_id'));
    }

    public function getCategory($id){
        $cate_ID = Category::find($id);
        //$category = Category::find($id)->product;
        $product_cate = Product::where('idCate', $id)->get();

        /*PHẦN  HIỆN  RA CÁC SẢN PHẨM LIÊN QUAN */
        $product_Noibat = Product::where('outstanding', '=', 1)->where('idCate', '=', $id)->orderBy('id','DESC')->take(10)->get();
        $tra_relative_shop = Trademark::all();

        return view('pages.category', compact('cate_ID', 'product_cate', 'product_Noibat', 'tra_relative_shop'));
    }

    //-----------------     Phần POST - BÀI VIẾT  --------------
    public function getPost(){
        $post = Post::paginate(9);
        return view('pages.post', compact('post'));
    }
    public function getPostSingle($id){
        $postSingle = Post::find($id);
        $post = Post::paginate(3);
        return view('pages.post_single', compact('postSingle', 'post'));
    }
    
    // -------------------    TÌM KIẾM    -----------------------
    public function search(Request $request){
        $keyword = $request->keyword;

        $pro_search = Product::where('name_pro', 'like', "%$keyword%")->orWhere('description_pro', 'like', "%$keyword%")->take(30)->paginate(20);

        /*PHẦN  HIỆN  RA CÁC SẢN PHẨM LIÊN QUAN */
        $pro_relative_search = Product::all();
        $tra_relative_search = Trademark::all();

        return view('pages.search', compact('pro_search', 'pro_relative_search', 'tra_relative_search', 'keyword'));
    }

    public function postComment(Request $request, $id){
        //echo $request->content_cmt;
        if(Auth::check()){
            $validatedData = $request->validate([
            'content_cmt' => 'required',
            ],
                [
                'content_cmt.required' => 'Nội dung không được bỏ trống !',
                ]
            );

           /* $product = Product::find($id);*/
            $cmt = new Comment();

            $cmt->idUser = Auth::user()->id;
            $cmt->idProduct = $id;
            $cmt->content_cmt = $request->content_cmt;
            $cmt->save();
            return redirect("product/$id")->with('notify', 'Bạn đã bình luận thành công!');
        }else{
            $product = Product::find($id);
            return redirect("product/$id")->with('errorNotify', 'Bạn cần phải đăng nhập trước khi bình luận!');
        }
    }
    public function postListComment(Request $request, $idPro, $id){
        if(Auth::check()){
            $validatedData = $request->validate([
            'content' => 'required',
            ],
                [
                'content.required' => 'Nội dung không được bỏ trống !',
                ]
            );

           /* $product = Product::find($id);*/
            $ListCmt = new ListComment();

            $ListCmt->idUser = Auth::user()->id;
            $ListCmt->idComment = $id;
            $ListCmt->content = $request->content;

            $ListCmt->save();
            return redirect("product/$idPro")->with('notify', 'Bạn đã bình luận thành công!');
        }else{
            $product = Product::find($id);
            return redirect("product/$idPro")->with('errorNotify', 'Bạn cần phải đăng nhập trước khi bình luận!');
        }
    }


    /*   --------------------- ĐĂNG NHẬP - ĐĂNG XUẤT  --------------   */
    public function getLogin(){
        return view('pages.login');
    }
    public function postLogin(Request $request){
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ], 
            [
                'email.required'=>'Bạn chưa nhập email !!!',
                'password.required'=>'Bạn chưa nhập mật khẩu !!!',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự !!!'
            ]
        );

        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password, 'confirmed'=>1])) {
            return redirect('home');
        }
        if (Auth::attempt(['name'=>$request->email, 'password'=>$request->password, 'confirmed'=>1])) {
            return redirect('home');
        }else{
            return redirect('login')->with('notify', 'Sai tài khoản hoặc mật khẩu, hoặc bạn chưa xác nhận email!');
        }
    }
    public function getLogout(){
        Auth::logout();
        Cart::destroy();
        
        return redirect('home');
    }
    
    public function getRegister(){
        return view('pages.register');
    }
    public function postRegister(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|min:2|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'passwordAgain' => 'required|same:password',
            'phone' => 'required|regex:/^(0)[0-9]{9}$/'
        ], 
            [
                'name.required'=>'Tên đămg nhập bắt buộc phải nhập !!!',
                'name.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
                'name.unique'=>'Tên này đã có người sử dụng, mời bạn chọn tên mới!',
                
                'email.required'=>'Bạn chưa nhập email !!!',
                'email.unique'=>'Email này đã tồn tại !!!',

                'password.required'=>'Bạn chưa nhập mật khẩu !!!',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự !!!',
                
                'passwordAgain.required'=>'Bạn chưa nhập mật khẩu xác nhận !!!',
                'passwordAgain.same'=>'Mật khẩu xác nhận chưa đúng !!!',

                'phone.required'=>'Bạn chưa nhập số điện thoại !!!',
                'phone.regex'=>'SĐT không đúng định dạng !!!'
            ]
        );

        $user = new User();
        $user->id = $request->id;
        $user->name = $request->name;
        $user->avatar = "no-image.png";
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->idTypeUser = "3";
        
        $code = time().uniqid(true);
        $confirmation_code = ['conf' => $code];
        Mail::send('pages.confirm_user', $confirmation_code, function($message) use ($user){
            $message->from('anhlotest@gmail.com', 'Cudlo Shop');
            $message->to($user->email, $user->name)->subject('Đây là mail xác nhận từ Cudlo shop');
        });

        $user->confirmation_code = $code;
        $user->token = $code;
        $user->save();

        return redirect('register')->with('notify', 'Vui lòng kiểm tra email để xác nhận việc đăng ký!');
    }
    public function verify($code){
        $user = User::where('confirmation_code', $code);

        if ($user->count() > 0) {
            $user->update([
                'confirmed' => 1,
                'confirmation_code' => null
            ]);
            $notification_status = 'Kích hoạt tài khoản thành công. Bạn có thể đăng nhập ngay';
        } else {
            $notification_status ='Mã xác nhận không chính xác';
        }

        return redirect('login')->with('notify', $notification_status);
    }

    // ------------- Phần Reset Password
    public function getReset(){
        return view('pages.reset-password');
    }
    public function postReset(Request $request){
        if ($request->email)
        {
            $checkUser  = User::where('email',$request->email)->first();
            if ($checkUser)
            {
                $token = ['conf' => $checkUser->token];
                Mail::send('pages.confirm_resetpassword', $token, function($message) use ($checkUser){
                    $message->from('anhlotest@gmail.com', 'Cudlo Shop');
                    $message->to($checkUser->email, $checkUser->name)->subject('Đây là mail xác nhận việc cài đặt lại mật khẩu từ Cudlo Shop');
                });
                return redirect('reset-password')->with('notifySuccess', 'Vui lòng kiểm tra email để xác nhận!');
            }
            return redirect('reset-password')->with('notifyFail', 'Email này chưa đăng ký!');
        }

        /*$user = User::all();
        foreach ($user as $value)
        {
            if($value->email == $request->email){
                $token = ['conf' => $value->token];
                Mail::send('pages.confirm_resetpassword', $token, function($message) use ($value){
                    $message->from('anhlotest@gmail.com', 'Cudlo Shop');
                    $message->to($value->email, $value->name)->subject('Đây là mail xác nhận việc cài đặt lại mật khẩu từ Cudlo Shop');
                });
                return redirect('reset-password')->with('notifySuccess', 'Vui lòng kiểm tra email để xác nhận!');
            }
        }
        return redirect('reset-password')->with('notifyFail', 'Email này chưa đăng ký!');*/
    }
    public function getVerifyReset($code){
        $user = User::where('token', $code);

        if ($user->count() > 0) {
            $token_code = $code;
            return view('pages.change-password', compact('token_code'));
        } else {
            return redirect('reset-password')->with('resetPass', 'Mã xác nhận không chính xác');
        }
        
    }
    public function postVerifyReset($code, Request $request){
        $validatedData = $request->validate([
            'password' => 'required|min:6',
            'passwordAgain' => 'required|same:password',
        ], 
            [
                'password.required'=>'Bạn chưa nhập mật khẩu !!!',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự !!!',
                
                'passwordAgain.required'=>'Bạn chưa nhập mật khẩu xác nhận !!!',
                'passwordAgain.same'=>'Mật khẩu xác nhận chưa đúng !!!'
            ]
        );

        $user = User::where('token', $code);
        if ($user->count() > 0) {
            $new_code = time().uniqid(true);
            $user->update([
                'password' => bcrypt($request->password),
                'token' => $new_code
            ]);
            $notification_status = 'Bạn có thể đăng nhập bằng mật khẩu mới';
        } else {
            $notification_status ='Mã xác nhận không chính xác';
        }
        return redirect('login')->with('notify', $notification_status);
    }

//  Khách hàng tự thay đổi thông tin của mình
    public function getClient(){
        $province = Province::all();
        $district = District::all();
        $commune = Commune::all();
        return view('pages.edit_client', compact('province', 'district', 'commune'));
    }
    public function postClient(Request $request){
        $validatedData = $request->validate([
            'phone' => 'required|regex:/^(0)[0-9]{9}$/',
            'avatar' => 'unique:users',
        ], 
            [
                'phone.required'=>'Bạn chưa nhập số điện thoại !!!',
                'phone.regex'=>'SĐT không đúng định dạng !!!',

                'avatar.unique'=>'Tên ảnh này đã tồn tại !!!'
            ]
        );

        $user = Auth::user();

        if($request->hasFile("avatar")){
            $fileAnh = $request->File("avatar");

            $duoi = $fileAnh->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'JPG' && $duoi != 'png' && $duoi != 'PNG' && $duoi != 'jpeg' && $duoi != 'JPEG'){
                return redirect('admin/user/edit/'. $id)->with('loi', 'Ảnh không hợp lệ');
            }

            $name = $fileAnh->getClientOriginalName();
            $newName = str_random(5)."_".$name;
            while(file_exists("upload/user".$newName)){
                $newName = str_random(5)."_".$name;
            }

            $fileAnh->move("upload/user", $newName);
            //unlink("upload/user/" .$user->avatar);
            $user->avatar = $newName;
        }

        if($request->changePassword == "on"){
            $validatedData = $request->validate([
            'password' => 'required|min:6',
            'passwordAgain' => 'required|same:password'
            ], 
                [
                    'password.required'=>'Bạn chưa nhập mật khẩu !!!',
                    'password.min'=>'Mật khẩu ít nhất 6 ký tự !!!',
                    
                    'passwordAgain.required'=>'Bạn chưa nhập mật khẩu xác nhận !!!',
                    'passwordAgain.same'=>'Mật khẩu xác nhận chưa đúng !!!'
                ]
            ); 
            $user->password = bcrypt($request->password);
        }

        $pro = Province::where('id', $request->province)->first();
        $dis = District::where('maqh', $request->district)->first();
        $com = Commune::where('xaid', $request->commune)->first();

        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->phone = $request->phone;

        if($request->changeAddress == "on"){
            $validatedData = $request->validate([
            'house_number' => 'required'
            ], 
                [
                    'house_number.required'=>'Bạn chưa nhập số nhà này !!!'
                ]
            ); 
            $user->address = $request->house_number." - " .$com->name ." - " .$dis->name ." - " .$pro->name;
        }
        $user->gender = $request->gender;

        $user->save();
        return redirect('client')->with('notify', 'Bạn đã cập nhật thành công!');
    }
}
