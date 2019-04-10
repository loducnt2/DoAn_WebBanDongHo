<!-- Top Bar -->
@foreach($company as $itemCompany)
<div class="top_bar">
	<div class="container">
		<div class="row">
			<div class="col d-flex flex-row">
				<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ url('images/phone.png') }}" alt=""></div>{{ $itemCompany->phone_company }}</div>
				<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ url('images/mail.png') }}" alt=""></div>{{ $itemCompany->email_company }}</div>
				<div class="top_bar_content ml-auto">
					<div class="top_bar_menu">
						<!-- <ul class="standard_dropdown top_bar_dropdown">
							<li>
								<a href="#">English<i class="fas fa-chevron-down"></i></a>
								<ul>
									<li><a href="#">Italian</a></li>
									<li><a href="#">Spanish</a></li>
									<li><a href="#">Japanese</a></li>
								</ul>
							</li>
							<li>
								<a href="#">$ US dollar<i class="fas fa-chevron-down"></i></a>
								<ul>
									<li><a href="#">EUR Euro</a></li>
									<li><a href="#">GBP British Pound</a></li>
									<li><a href="#">JPY Japanese Yen</a></li>
								</ul>
							</li>
						</ul> -->
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
								<div class="custom_dropdown">
									<div class="custom_dropdown_list">
										<span class="custom_dropdown_placeholder clc"></span>
										<!-- <i class="fas fa-chevron-down"></i>  -->
										<ul class="custom_list clc">
											<li><a class="clc" href="#">All Categories</a></li>
											<li><a class="clc" href="#">Computers</a></li>
											<li><a class="clc" href="#">Laptops</a></li>
											<li><a class="clc" href="#">Cameras</a></li>
											<li><a class="clc" href="#">Hardware</a></li>
											<li><a class="clc" href="#">Smartphones</a></li>
										</ul>
									</div>
								</div>
								<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ url('images/search.png') }}" alt=""></button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Wishlist -->
			<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
				<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
					<!-- <div class="wishlist d-flex flex-row align-items-center justify-content-end">
						<div class="wishlist_icon"><img src="images/heart.png" alt=""></div>
						<div class="wishlist_content">
							<div class="wishlist_text"><a href="#">Wishlist</a></div>
							<div class="wishlist_count">115</div>
						</div>
					</div> -->

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