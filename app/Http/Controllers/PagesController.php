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
                        'discount_pro' => $product->discount_pro
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
    public function updateCart(Request $request){
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
        return view('cart.checkout');
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
            'delivery_phone' => 'required|regex:/^(0)[0-9]{9}$/',
            'delivery_address' => 'required'
        ], 
            [
                'delivery_phone.required'=>'Bạn chưa nhập số điên thoại nhận hàng !!!',
                'delivery_phone.regex'=>'SĐT không đúng định dạng !!!',
                'delivery_address.required'=>'Bạn chưa nhập địa chỉ giao hàng !!!'
            ]
        );


        $totalAmount = 0; 
        foreach (Cart::content() as $key => $item){
            $Newdiscount = (100-$item->options->discount_pro)/100;
            $totalAmount += ($item->qty*$item->price*$Newdiscount);
        }

        $order = new Order();
        
        $order->delivery_phone = $request->delivery_phone;
        $order->delivery_address = $request->delivery_address;
        $order->note_order = $request->note_order;
        $order->total = $totalAmount;
        $order->status_order = 1;
        $order->idEmployee = 1;

        if(Auth::check()) {
            $order->idUser = Auth::user()->id;
        }

        /*echo "<pre>";
        //print_r($relative_pro->toArray());
        echo Auth::user()->id;
        die();*/

        $order->save();


        //luu thong tin chi tiet hoa don
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
        }
       /* $order->amount = $totalAmount;*/

        //xoa gio hang
        Cart::destroy();
        $id_cus = Auth::user()->id;
        //return redirect('home')->with('success', 'Bạn đã đặt hàng thành công!!!');
        return redirect('cart/order/'.$id_cus)->with('success', 'Bạn đã đặt hàng thành công!!!');
    }

    public function getOrder($id){
        if(Auth::check()) {
            $id = Auth::user()->id;
            //$detail = Order::find($id)->orderdetail()->get();

            //$orders = Order::find($id);

            $detail = Orderdetail::select('orderdetails.id', 'orderdetails.idOrder', 'orderdetails.idProduct', 'orderdetails.quantity', 'orderdetails.price', 'orderdetails.discount', 'orderdetails.created_at', 'orderdetails.updated_at')
            ->join('orders', 'orders.id', '=', 'orderdetails.idOrder')
            ->where('orders.idUser', $id)
            ->where('orders.status_order', '<>', 0)
            ->where('orders.status_order', '<>', 3)
            ->get();

            $orders = Order::select('orders.id', 'orders.idUser', 'orders.delivery_phone', 'orders.delivery_address', 'orders.note_order', 'orders.total', 'orders.status_order','orders.created_at', 'orders.updated_at', 'users.name')
            ->join('users', 'users.id', '=', 'orders.idUser')
            ->where('orders.idUser', $id)
            ->where('orders.status_order', '<>', 0)
            ->where('orders.status_order', '<>', 3)
            ->get();


       /* echo "<pre>";
        print_r($orders->toArray());
        die();
*/

            return view('cart.order', compact('detail', 'orders'));
        }else{
            die('Bạn chưa tạo hóa đơn nào');
        }
        
       
        
    }
    public function postOrder($id){
        $id = Auth::user()->id;

        $order = DB::update('update orders set status_order = 3 where orders.status_order = 1 OR orders.status_order = 2 AND orders.idUser = '.$id);

        return redirect('home')->with('notifyDeleteOrder', 'Bạn đã hủy đơn hàng thành công!');
    }

   /* - - - - - -    END LARAVEL CART   - - - - -  - - -*/  
	public function getHome(){
		//$product = Product::all();
		$product = Product::orderBy('id','DESC')->take(24)->get();
		$product_dis = Product::where('discount_pro', '>', 0)->orderBy('id','DESC')->take(24)->get();
        $products_hot_sell = Product::select('products.*')
            ->join('orderdetails', 'products.id', '=', 'orderdetails.idProduct')
            ->where('orderdetails.quantity','>', '1')
            ->take(24)
            ->get();
        $product_Noibat = Product::where('outstanding', '=', 1)->orderBy('id','DESC')->take(10)->get();

        $cate_home = Category::take(3)->get();
        $product_1 = Category::find(1)->product()->get();
        $product_3 = Category::find(3)->product()->get();
        $product_4 = Category::find(4)->product()->get();

        $trade_1 = Product::where('idTrade', '=', 1)->orderBy('id','DESC')->take(20)->get();
        $trade_2 = Product::where('idTrade', '=', 2)->orderBy('id','DESC')->take(20)->get();
        $trade_3 = Product::where('idTrade', '=', 3)->orderBy('id','DESC')->take(20)->get();
        // Sản phẩm mới ở banner giữa
        $new_product = Product::orderBy('id','DESC')->take(5)->get();

		/*echo "<pre>";
        print_r($trade_1->toArray());
        die();
*/
    	return view('pages.home', compact('product', 'product_dis', 'product_Noibat', 'cate_home', 'product_1', 'product_3', 'product_4', 'new_product', 'trade_1', 'trade_2', 'trade_3', 'products_hot_sell'));
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
        $pro_shop = Product::where('idTrade', $id)->paginate(20);

        /*PHẦN  HIỆN  RA CÁC SẢN PHẨM LIÊN QUAN */
        $pro_relative_shop = Product::all();
        $tra_relative_shop = Trademark::all();

    	return view('pages.shop', compact('tra_shop', 'pro_shop', 'pro_relative_shop', 'tra_relative_shop'));
    }
    public function getProduct($id){
        $pro_pro = Product::find($id);
        $img_pro = Image::where('idProduct', $id)->orderBy('id','DESC')->take(3)->get();

        $trade_id = $pro_pro->trade->id;
            /*PHẦN  HIỆN  RA CÁC SẢN PHẨM LIÊN QUAN */
        $relative_pro = Product::select('products.*')
            ->join('trademarks', 'products.idTrade', '=', 'trademarks.id')
            ->where('trademarks.id', $trade_id)
            ->where('products.id', '!=', $id)
            ->get();
        /*echo "<pre>";
        print_r($relative_pro->toArray());
        die();*/

        return view('pages.product', compact('pro_pro', 'relative_pro', 'img_pro'));
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
        return view('pages.edit_client');
    }
    public function postClient(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|min:2|unique:users',
            'phone' => 'required|regex:/^(0)[0-9]{9}$/',
            'address' => 'required|min:2',
            'avatar' => 'unique:users',
        ], 
            [
                'name.required'=>'Tên đămg nhập bắt buộc phải nhập !!!',
                'name.min'=>'Tên từ 2 - 100 ký tự nhé !!!',
                'name.unique'=>'Tên này đã có người sử dụng, mời bạn chọn tên mới!',

                'phone.required'=>'Bạn chưa nhập số điện thoại !!!',
                'phone.regex'=>'SĐT không đúng định dạng !!!',

                'address.required'=>'Bạn chưa nhập địa chỉ !!!',
                'address.min'=>'Địa chỉ từ 2 ký tự trở lên !!!', 

                'avatar.unique'=>'Tên ảnh này đã tồn tại !!!'
            ]
        );

        $user = Auth::user();
        $user->name = $request->name;
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

        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
    
        $user->save();
        return redirect('client')->with('notify', 'Bạn đã cập nhật thành công!');
    }

}
