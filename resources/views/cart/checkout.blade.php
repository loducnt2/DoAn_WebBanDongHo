<!DOCTYPE html>
<html lang="en">
<head>
<title>Thanh toán đặt hàng</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick-1.8.0/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/responsive.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_responsive.css') }}">
</head>

<body>
<div class="super_container">
	
	<!-- Header -->
	@foreach($company as $itemCompany)
	<header class="header">
		<!--  Page-header  -->
			<div class="top_bar">
				<div class="container">
					<div class="row">
						<div class="col d-flex flex-row">
							<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ url('images/phone.png') }}" alt=""></div>{{ $itemCompany->phone_company }}</div>
							<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ url('images/mail.png') }}" alt=""></div>{{ $itemCompany->email_company }}</div>
							<div class="top_bar_content ml-auto">
								<div class="top_bar_menu">
								</div>
								<div class="top_bar_user">
									<div class="user_icon">
										<!-- <img src="{{ url('images/user.svg') }}" alt=""> -->
									</div>
									@if(!isset($user_client))
									<div><a href="{{ url('register') }}">Đăng ký</a></div>
									<div><a href="{{ url('login') }}">Đăng nhập</a></div>
									@else
										<!-- <div class="user_icon">
											<img src="{{ url('images/user.svg') }}" alt="">
										</div> -->
										<div>
											<a href="{{ url('client') }}">{{ $user_client->name }}</a>
										</div>
										<div><a href="{{ url('logout') }}">Đăng xuất</a></div>
									@endif
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						@if (session('notifyNews'))
					        <div class="alert alert-success">{{session('notifyNews')}}</div>
					    @endif
					</div>

				</div>		
			</div>

			<!-- Header Main -->
			<div class="header_main">
				<div class="container">
					<div class="row">

						<!-- Logo -->
						<div class="col-lg-2 col-sm-3 col-3 order-1">
							<div class="logo_container">
								<div class="logo"><a href="{{ url('home') }}">{{ $itemCompany->name_company }}</a></div>
							</div>
						</div>

						<!-- Search -->
						<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
							<div class="header_search">
								<div class="header_search_content">
									<div class="header_search_form_container">
										<form action="{{ url('search') }}" method="POST" class="header_search_form clearfix">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="text" name="keyword" class="header_search_input" placeholder="Tìm kiếm sản phẩm...">
											<!-- <div class="custom_dropdown">
												<div class="custom_dropdown_list">
													<span class="custom_dropdown_placeholder clc">All Categories</span>
													<i class="fas fa-chevron-down"></i>
													<ul class="custom_list clc">
														<li><a class="clc" href="#">All Categories</a></li>
														<li><a class="clc" href="#">Computers</a></li>
														<li><a class="clc" href="#">Laptops</a></li>
														<li><a class="clc" href="#">Cameras</a></li>
														<li><a class="clc" href="#">Hardware</a></li>
														<li><a class="clc" href="#">Smartphones</a></li>
													</ul>
												</div>
											</div> -->
											<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ url('images/search.png') }}" alt=""></button>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Wishlist -->
						<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
							<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">

								<!-- Cart -->
								<div class="cart">
									<div class="cart_container d-flex flex-row align-items-center justify-content-end">
										<div class="cart_icon">
											<img src="{{ url('images/cart.png') }}" alt="">
											<div class="cart_count"><span>
				                                {{ count(Cart::content()) }}
											</span></div>
										</div>
										<div class="cart_content">
											<div class="cart_text"><a href="{{ url('cart') }}">Cart</a></div>
											<div class="cart_price">
												<?php $total = 0; ?>
				                                @if(Cart::content())
				                                    @foreach(Cart::content() as $item)
				                                         <?php 
			                                                $Newdiscount = (100-$item->options->discount_pro)/100;
			                                                $total += ($item->qty*$item->price*$Newdiscount);
			                                             ?>
				                                    @endforeach
				                                @endif
				                                {{ number_format($total) }} VNĐ
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		
		<!--  Page-menu-header  -->
		@include('layouts/menu-header')
		
		<!-- Menu -->

		<div class="page_menu">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="page_menu_content">
							
							<div class="page_menu_search">
								<form action="#">
									<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
								</form>
							</div>
							<ul class="page_menu_nav">
								<li class="page_menu_item has-children">
									<a href="#">Language<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Currency<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item">
									<a href="#">Home<i class="fa fa-angle-down"></i></a>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
										<li class="page_menu_item has-children">
											<a href="#">Menu Item<i class="fa fa-angle-down"></i></a>
											<ul class="page_menu_selection">
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
												<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
											</ul>
										</li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item has-children">
									<a href="#">Trending Styles<i class="fa fa-angle-down"></i></a>
									<ul class="page_menu_selection">
										<li><a href="#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									</ul>
								</li>
								<li class="page_menu_item"><a href="blog.html">blog<i class="fa fa-angle-down"></i></a></li>
								<li class="page_menu_item"><a href="contact.html">contact<i class="fa fa-angle-down"></i></a></li>
							</ul>
							
							<div class="menu_contact">
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{ url('images/phone_white.png') }}" alt=""></div>+38 068 005 3570</div>
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{ url('images/mail_white.png') }}" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>
	
	<!-- Page - home -->
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title" style="font-family: arial; font-weight: bold;">Sản phẩm</div>
						@if(count($errors) > 0)
		                    <div class="alert alert-danger">
		                        <ul>
		                            @foreach($errors->all() as $item)
		                                <li>{{ $item }}</li>
		                            @endforeach
		                        </ul>
		                    </div>
		                @endif

						@if(session('error'))
		                    <div class="alert alert-danger">
		                        {{ session('error') }}
		                    </div>
		                @endif

						<div class="cart_items">
							<ul class="cart_list">

							<?php $totalAmount = 0; ?>
							@foreach(Cart::content() as $item)
								<li class="cart_item clearfix">
									<div class="cart_item_image">
										<a href='{{ url("product/$item->id") }}'>
										 <img src='{{ url("upload/product/" .$item->options->thumbnail_pro) }}' width="100px" height="100px" width="50px" height="50px"> 
										 </a>
									</div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Tên</div>
											<div class="cart_item_text">{{ $item->name }}</div>
										</div>
										<!-- <div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Color</div>
											<div class="cart_item_text"><span style="background-color:#999999;"></span>Silver</div>
										</div> -->
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Số lượng</div>
											<div class="cart_item_text">
												{{ $item->qty }}
											</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Khuyến mại</div>
											<div class="cart_item_text">{{ number_format($item->options->discount_pro) }}%</div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Giá</div>
											<div class="cart_item_text">{{ number_format($item->price) }}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Tổng</div>
											<div class="cart_item_text">
											<?php 
                                                $Newdiscount = (100-$item->options->discount_pro)/100;
                                                $totalAmount += ($item->qty*$item->price*$Newdiscount);
                                             ?>

											{{ number_format($item->price * $item->qty * $Newdiscount) }}
											</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Chọn</div>
											<div class="cart_item_text">
												<a href="{{ url('cart/remove/'.$item->id) }}">Xóa</a>
											</div>
										</div>
									</div>
								</li>
							@endforeach
							</ul>

						</div>
						
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Tổng tiền:</div>
								<div class="order_total_amount">{{ number_format($totalAmount) }} VND</div>
							</div>
						</div>

						<div class="cart_title ">
							<h2 style="margin-top: 50px;" style="font-family: arial;">Thông tin giao hàng</h2>
						</div>
						<div class="cart_items">
							<form action="{{ url('checkout') }}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							    <div class="form-group">
							    	<label for="delivery_phone">Số điện thoại nhận hàng(*)</label>
							    	<input type="text" name="delivery_phone" 
							    	@if(Auth::check())
							    		value="{{ Auth::user()->phone }}" 
							    	@else
							    		value="" 
							    	@endif
							    	class="form-control" style="color: black;">
							    </div>
							    <div class="form-group">
							    	<label for="delivery_address">Địa chỉ giao hàng(*)</label>
							    	<input type="text" name="delivery_address" id="delivery_address" disabled="" 
							    	@if(Auth::check())
							    		value="{{ Auth::user()->address }}" 
							    	@else
							    		value="" 
							    	@endif
							    	class="form-control" style="color: black;" >
							    </div>

							    <div class="form-group">
                                    <input type="checkbox" id="changeAddress" name="changeAddress">
                                    <label>Thay đổi địa chỉ</label>
                                </div>
                                <div class="form-group">
                                    <label>Tỉnh/Thành phố</label>
                                    <select class="form-control province" name="province" id="province" disabled="" style="color: black; width: 100% !important;">
                                        @foreach($province as $item)
                                            <option value="{{ $item->id }}" id="op_province">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Quận/Huyện</label>
                                    <select class="form-control district" name="district" id="district" disabled="" style="color: black;">
                                        @foreach($district as $dis)
                                            <option value="{{ $dis->maqh }}">{{ $dis->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Phường/Xã</label>
                                    <select class="form-control commune" name="commune" id="commune" disabled="" style="color: black;">
                                        @foreach($commune as $comm)
                                            <option value="{{ $comm->xaid }}">{{ $comm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tên nhà, tên đường</label>
                                    <input class="form-control house_number" value="" name="house_number" placeholder="Số nhà, Tên đường" disabled="" style="color: black;">
                                </div>
							    <div class="form-group">
							    	<label for="note_order">Lời nhắn:</label>
							    	<textarea class="form-control" rows="3" name="note_order" style="color: black;" placeholder="Lời nhắn..."></textarea>
							    </div>

							    <button type="submit" class="btn btn-info">Đặt hàng</button>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- END-Page-home -->
	

	<!-- Page - footer -->
	@include('layouts/footer')


	
</div>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('plugins/slick-1.8.0/slick.js') }}"></script>
<script src="{{ asset('plugins/easing/easing.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script src="{{ asset('js/cart_custom.js') }}"></script>

<script type="text/javascript">
        $("#changeAddress").change(function(){
            if($(this).is(":checked")){
                $(".province").removeAttr('disabled');
                $(".district").removeAttr('disabled');
                $(".commune").removeAttr('disabled');
                $(".house_number").removeAttr('disabled');
            }else{
                $(".province").attr('disabled', '');
                $(".district").attr('disabled', '');
                $(".commune").attr('disabled', '');
                $(".house_number").attr('disabled', '');
            }
        });

        var idProvince = $("#province").val();
         $.get("thanhpho/"+idProvince, function(data){
            $("#district").html(data);
        });
        var idDistrict = $("#district").val();
        $.get("huyen/"+idDistrict, function(data){
            $("#commune").html(data);
        });

        $("#province").change(function(){
            var idProvince = $(this).val();
            $.get("thanhpho/"+idProvince, function(data){
                $("#district").html(data);

                var idDistrict = $("#district").val();
                $.get("huyen/"+idDistrict, function(data){
                    $("#commune").html(data);
                });
                $("#district").change(function(){
                    var idDistrict = $(this).val();
                    $.get("huyen/"+idDistrict, function(data){
                        $("#commune").html(data);
                    });
                });
            });
        });  
        $("#district").change(function(){
            var idDistrict = $(this).val();
            $.get("huyen/"+idDistrict, function(data){
                $("#commune").html(data);
            });
        });  
</script>

</body>

</html>