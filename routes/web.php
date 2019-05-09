<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
	- chưa chỉnh ảnh địa diện (Admin)
	- 
*/

Route::get('/', 'PagesController@getHome');
Route::get('home', 'PagesController@getHome');
Route::post('home', 'PagesController@postHome');
/*Route::get('home/{id}', 'PagesController@getHome');*/

/* - - - - - -    LARAVEL CART   - - - - -  - - -*/  
Route::get('cart', 'PagesController@index');

Route::get('cart/add/{id}', 'PagesController@store');

Route::get('cart/remove/{id}', 'PagesController@destroy');
Route::get('cart/destroy', 'PagesController@destroyAll');

Route::get('checkout', 'PagesController@getCheckout');
Route::post('checkout', 'PagesController@postCheckout');

Route::get('cart/order/{id}', 'PagesController@getOrder');
Route::post('cart/order/{id}', 'PagesController@postOrder');

Route::post('cart/{id}', 'PagesController@updateQty');
/* - - - - - -    End LARAVEL CART   - - - - -  - - -*/  

Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');

Route::get('post', 'PagesController@getPost');
Route::get('post/{id}/{UnsignTitle}.html', 'PagesController@getPostSingle');

Route::get('regular', 'PagesController@getRegular');

Route::get('shop/{id}', 'PagesController@getShop');
Route::get('product/{id}', 'PagesController@getProduct');
Route::get('category/{id}', 'PagesController@getCategory');

Route::post('search', 'PagesController@search');

Route::post('comment/{id}', 'PagesController@postComment');
Route::post('list-comment/{idPro}/{id}', 'PagesController@postListComment');

/* - - - -- - -  ĐĂNG NHẬP   -   ĐĂNG XUẤT      - - - -- */
Route::get('login', 'PagesController@getLogin');
Route::post('login', 'PagesController@postLogin');
Route::get('logout', 'PagesController@getLogout');

Route::get('register', 'PagesController@getRegister');
Route::post('register', 'PagesController@postRegister');
Route::get('register/verify/{code}', 'PagesController@verify');

Route::get('reset-password', 'PagesController@getReset');
Route::post('reset-password', 'PagesController@postReset');
Route::get('reset-password/verify/{code}', 'PagesController@getVerifyReset');
Route::post('reset-password/verify/{code}', 'PagesController@postVerifyReset');

Route::get('client', 'PagesController@getClient');
Route::post('client', 'PagesController@postClient');
Route::get('thanhpho/{idProvince}', 'Admin\AjaxController@getHuyen');
Route::get('huyen/{idDistrict}', 'Admin\AjaxController@getXaPhuong');

/* - - - -- - -      FOOTER      - - - -- */
Route::get('introduce', 'PagesController@getIntroduce');
Route::get('introduce1', 'PagesController@getIntroduce1');
Route::get('resolve_complaints', 'PagesController@getResolveComplaints');
Route::get('rules', 'PagesController@getRules');

Route::get('warranty_policy', 'PagesController@getWarranty');
Route::get('return_policy', 'PagesController@getReturnPolicy');
Route::get('info_security_policy', 'PagesController@getInfoSecurity');
Route::get('policy_foreigner', 'PagesController@getPolicyForeigner');
Route::get('delivery_policy', 'PagesController@getDeliveryPolicy');
Route::get('payment_guide', 'PagesController@getPaymentGuide');
Route::get('shopping_guide', 'PagesController@getShoppingGuide');

/*- - - - - - - - - - - - - - - - - - - - - -  */

Route::get('print','pdfController@print');
Route::get('hoa_don_da_hoan_thanh','pdfController@finish');
Route::get('hoa_don_dang_duoc_xu_ly','pdfController@processing');
Route::get('hoa_don_dang_duoc_gui','pdfController@sending');
Route::get('hoa_don_bi_huy','pdfController@cancel');

Route::get('admin/login', 'Admin\UserController@getLoginAdmin');
Route::post('admin/login', 'Admin\UserController@postLoginAdmin');
Route::get('admin/logout', 'Admin\UserController@getLogoutAdmin');

Route::group(['middleware'  => ['adminLogin']], function (){
	Route::group(['prefix'=>'admin'], function () {

		Route::get('adminpage', 'Admin\DashboardController@index');

		Route::group(['prefix'=>'typeuser'], function () {
			Route::group(['middleware'  => ['adminAuthority']], function (){
		    	Route::get('list', 'Admin\TypeUserController@getList');

		    	Route::get('create', 'Admin\TypeUserController@getCreate');
		    	Route::post('create', 'Admin\TypeUserController@postCreate');

		    	Route::get('edit/{id}', 'Admin\TypeUserController@getEdit');
		    	Route::post('edit/{id}', 'Admin\TypeUserController@postEdit');

		    	Route::get('delete/{id}', 'Admin\TypeUserController@getDelete');
	    	});
		});
	    Route::group(['prefix'=>'user'], function () {
	        Route::group(['middleware'  => ['adminAuthority']], function (){
	        	Route::get('list', 'Admin\UserController@getList');
		        Route::get('create', 'Admin\UserController@getCreate');
		        Route::post('create', 'Admin\UserController@postCreate');

		        Route::get('delete/{id}', 'Admin\UserController@getDelete');
	        });

	        Route::get('edit/{id}', 'Admin\UserController@getEdit');
	        Route::post('edit/{id}', 'Admin\UserController@postEdit');
	    });
	    Route::group(['prefix'=>'category'], function () {
	    	Route::group(['middleware'  => ['adminAuthority']], function (){
		        Route::get('list', 'Admin\CategoryController@getList');

		        Route::get('create', 'Admin\CategoryController@getCreate');
		        Route::post('create', 'Admin\CategoryController@postCreate');

		        Route::get('edit/{id}', 'Admin\CategoryController@getEdit');
		        Route::post('edit/{id}', 'Admin\CategoryController@postEdit');

		        Route::get('delete/{id}', 'Admin\CategoryController@getDelete');
	        });
	    });
	    Route::group(['prefix'=>'employee'], function () {
	        Route::group(['middleware'  => ['adminAuthority']], function (){
	        	Route::get('list', 'Admin\EmployeeController@getList');

		        Route::get('create', 'Admin\EmployeeController@getCreate');
	        	Route::post('create', 'Admin\EmployeeController@postCreate');

		        Route::get('delete/{id}', 'Admin\EmployeeController@getDelete');

		        Route::get('edit/{id}', 'Admin\EmployeeController@getEdit');
	        	Route::post('edit/{id}', 'Admin\EmployeeController@postEdit');
	        });
	    });

	    Route::group(['prefix'=>'trade'], function () {
	    	Route::group(['middleware'  => ['adminAuthority']], function (){
		        Route::get('list', 'Admin\TradeController@getList');

		        Route::get('create', 'Admin\TradeController@getCreate');
		        Route::post('create', 'Admin\TradeController@postCreate');

		        Route::get('edit/{id}', 'Admin\TradeController@getEdit');
		        Route::post('edit/{id}', 'Admin\TradeController@postEdit');

		        Route::get('delete/{id}', 'Admin\TradeController@getDelete');
	        });
	    });
	    Route::group(['prefix'=>'comment'], function () {
	        Route::get('list', 'Admin\CommentController@getList');
	        Route::get('delete/{id}/{idPro}', 'Admin\CommentController@getDelete');
	    });
	    Route::group(['prefix'=>'product'], function () {
	    	Route::group(['middleware'  => ['adminAuthority']], function (){
		        Route::get('list', 'Admin\ProductController@getList');

		        Route::get('create', 'Admin\ProductController@getCreate');
		        Route::post('create', 'Admin\ProductController@postCreate');

		        Route::get('edit/{id}', 'Admin\ProductController@getEdit');
		        Route::post('edit/{id}', 'Admin\ProductController@postEdit');

		        Route::get('delete/{id}', 'Admin\ProductController@getDelete');

		        Route::get('trade/{idCategory}', 'Admin\AjaxController@getTrade');
		    	Route::get('edit/trade/{idCategory}', 'Admin\AjaxController@getTrade');
	    	});
	    });
	    Route::group(['prefix'=>'image'], function () {
	    	Route::group(['middleware'  => ['adminAuthority']], function (){
		        Route::get('list', 'Admin\ImageController@getList');

		        Route::get('create', 'Admin\ImageController@getCreate');
		        Route::post('create', 'Admin\ImageController@postCreate');

		        Route::get('edit/{id}', 'Admin\ImageController@getEdit');
		        Route::post('edit/{id}', 'Admin\ImageController@postEdit');

		        Route::get('delete/{id}', 'Admin\ImageController@getDelete');
	        });
	    });
	    Route::group(['prefix'=>'order'], function () {
	        Route::get('list', 'Admin\OrderController@getList');
	        Route::get('order_finish', 'Admin\OrderController@getOrderFinish');
	        Route::get('order_processing', 'Admin\OrderController@getOrderProcessing');
	        Route::get('order_sending', 'Admin\OrderController@getOrderSending');
	        Route::get('order_cancel', 'Admin\OrderController@getOrderCancel');

	        Route::get('detail/{id}', 'Admin\OrderController@getDetail');

	        Route::get('edit/{id}', 'Admin\OrderController@getEdit');
	        Route::post('edit/{id}', 'Admin\OrderController@postEdit');

	        Route::get('delete/{id}', 'Admin\OrderController@getDelete');

	        Route::post('filter', 'Admin\OrderController@postFilter');
	    });
	    Route::group(['prefix'=>'orderdetail'], function () {
	        Route::get('list', 'Admin\OrderDetailController@getList');
	    });
	    Route::group(['prefix'=>'contact'], function () {
	        Route::get('list', 'Admin\ContactController@getList');

	        Route::get('delete/{id}', 'Admin\ContactController@getDelete');

	        Route::get('repcontact/{id}', 'Admin\ContactController@getRep');
	        Route::post('repcontact/{id}', 'Admin\ContactController@postRep');
	    });
	    Route::group(['prefix'=>'newsletter'], function () {
	        Route::get('list', 'Admin\NewsletterController@getList');

	        Route::get('send-mail', 'Admin\NewsletterController@getSendMail');
	        Route::post('send-mail', 'Admin\NewsletterController@postSendMail');

	        Route::get('delete/{id}', 'Admin\NewsletterController@getDelete');
	    });
	    Route::group(['prefix'=>'company'], function () {
	    	Route::group(['middleware'  => ['adminAuthority']], function (){
		        Route::get('list', 'Admin\CompanyController@getList');

		        Route::get('edit/{id}', 'Admin\CompanyController@getEdit');
		        Route::post('edit/{id}', 'Admin\CompanyController@postEdit');
	        });
	    });
	    Route::group(['prefix'=>'post'], function () {
	    	Route::group(['middleware'  => ['adminAuthority']], function (){
		        Route::get('list', 'Admin\PostController@getList');

		        Route::get('create', 'Admin\PostController@getCreate');
		        Route::post('create', 'Admin\PostController@postCreate');

		        Route::get('edit/{id}', 'Admin\PostController@getEdit');
		        Route::post('edit/{id}', 'Admin\PostController@postEdit');

		        Route::get('delete/{id}', 'Admin\PostController@getDelete');
	        });
	    });
	    Route::group(['prefix'=>'customercare'], function () {
	    	Route::group(['middleware'  => ['adminAuthority']], function (){
		        Route::get('list', 'Admin\CustomercareController@getList');

		        Route::get('edit/{id}', 'Admin\CustomercareController@getEdit');
		        Route::post('edit/{id}', 'Admin\CustomercareController@postEdit');
	        });
	    });
	});
});