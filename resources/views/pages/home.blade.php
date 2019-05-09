
@extends('layouts.index')

@section('tieude')
	Cudlo - Trang chủ
@endsection

@section('content')
<div class="banner">
	<div class="banner_background" style="background-image:url('images/banner_background.jpg')"></div>
	<div class="container fill_height">
		<div class="row fill_height">
			<div class="banner_product_image"><img src="images/imageHome.png" style="width: 31%; float: right;" alt="watch_banner"></div>
			<div class="col-lg-5 offset-lg-4 fill_height">
				<div class="banner_content">
					<h1 class="banner_text">Kỷ nguyên mới của đồng hồ</h1>
					<div class="banner_price"></div>
					<div class="banner_product_name"></div>
					<div class="button banner_button"><a href="{{ url('shop/1') }}">Mua sắm ngay</a></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Characteristics -->

<div class="characteristics">
	<div class="container">
		<div class="row">
			{{--Báo phần đặt hàng xong--}}
		    @if(Session::has('success'))
		        <!-- <div class="col-lg-12">
		            <p class="page-header" style="background-color: #09a80f; color: white; text-align: center;">
		                {{ Session::get('success') }}
		            </p>
		        </div> -->
		        <div class="alert alert-success">{{session('success')}}</div>
		    @endif
		</div>
		<div class="row">
			{{-- Báo phần hủy đơn hàng --}}
		    @if(Session::has('notifyDeleteOrder'))
		        <div class="alert alert-success">{{session('notifyDeleteOrder')}}</div>
		    @endif
		</div>
		
		
	</div>
</div>

<!-- Deals of the week -->

<div class="deals_featured" style="margin-bottom: 100px;">
	<div class="container">
		<div class="row">
			<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
				
				<!-- Deals -->

				<div class="deals">
					<div class="deals_title">Các sản phẩm nổi bật</div>
					<div class="deals_slider_container">
						
						<!-- Deals Slider -->
						<div class="owl-carousel owl-theme deals_slider">
							
							<!-- Deals Item -->
						@foreach($product_Noibat as $item)
							<div class="owl-item deals_item">
								<div class="deals_image">
									<a href='{{ url("product/$item->id") }}'>
									<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" alt="">
									</a>
								</div>
								<div class="deals_content">
									<div class="deals_info_line d-flex flex-row justify-content-start">
										<div class="deals_item_category">
											<a href='{{ url("shop/$item->idTrade") }}'>{{ $item->trade->name_trade }}</a>
										</div>
										<div class="deals_item_price_a ml-auto" style="text-decoration: line-through;">{{ $item->price_pro }}</div>
									</div>
									<div class="deals_info_line d-flex flex-row justify-content-start">
										<div class="deals_item_name">
										<a href='{{ url("product/$item->id") }}'>{{ $item->name_pro }}</a>
										</div>
										<?php 
                                            $totalAmount_NoiBat = 0; 
                                            $Newdiscount_NB = (100-$item->discount_pro)/100;
                                            $totalAmount_NoiBat += ($item->price_pro*$Newdiscount_NB);
                                        ?>
										<div class="deals_item_price ml-auto">{{ number_format($totalAmount_NoiBat) }}</div>
									</div>
									
								</div>
							</div>
						@endforeach

						</div>

					</div>

					<div class="deals_slider_nav_container">
						<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
						<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
					</div>
				</div>
				
				<!-- Featured -->
				<div class="featured">
					<div class="tabbed_container">
						<div class="tabs">
							<ul class="clearfix">
								<li class="active">Mới</li>
								<li>Khuyến mại</li>
								<li>Bán chạy</li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>

						<!-- Product Panel -->
						<div class="product_panel panel active">
							<div class="featured_slider slider">

								<!-- Slider Item  Sản phẩm mới -->
							@foreach($product as $item)
								<div class="featured_slider_item">
									<div class="border_active"></div>
									<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
										<div class="product_image d-flex flex-column align-items-center justify-content-center">
											<a href='{{ url("product/$item->id") }}'>
												<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" style="height: 100px;" alt="">
											</a>
										</div>
										<div class="product_content">
											<div class="product_price discount">
											<?php 
                                                $totalAmount = 0; 
                                                $Newdiscount = (100-$item->discount_pro)/100;
                                                $totalAmount += ($item->price_pro*$Newdiscount);
                                            ?>
												{{ number_format($totalAmount) }} VNĐ
												<span style="text-decoration: line-through;">{{ number_format($item->price_pro) }} VNĐ</span>
											</div>
											<div class="product_name">
												<div>
													<a href='{{ url("product/$item->id") }}'>{{ $item->name_pro }}</a>
												</div>
											</div>

											<div class="product_extras">
												<!-- <div class="product_color">
													<input type="radio" checked name="product_color" style="background:#b19c83">
													<input type="radio" name="product_color" style="background:#000000">
													<input type="radio" name="product_color" style="background:#999999">
												</div> -->
												<a href="{{ url('cart/add/'. $item->id ) }}">
													<button class="product_cart_button">Mua ngay</button>
												</a>
											</div>
										</div>
										<!-- <div class="product_fav"><i class="fas fa-heart"></i></div> -->
										<ul class="product_marks">
											<li class="product_mark product_discount">-{{ $item->discount_pro }}%</li>
											<li class="product_mark product_new">new</li>
										</ul>
									</div>
								</div>
							@endforeach

							</div>
							<div class="featured_slider_dots_cover"></div>
						</div>

						<!-- Product Panel -->

						<div class="product_panel panel">
							<div class="featured_slider slider">

								<!-- Slider Item Khuyến mại -->
								
							@foreach($product_dis as $item)
								<div class="featured_slider_item">
									<div class="border_active"></div>
									<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
										<div class="product_image d-flex flex-column align-items-center justify-content-center">
											<a href='{{ url("product/$item->id") }}'>
												<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" style="height: 100px;" alt="">
											</a>
										</div>
										<div class="product_content">
											<div class="product_price discount">
											<?php 
                                                $totalAmount = 0; 
                                                $Newdiscount = (100-$item->discount_pro)/100;
                                                $totalAmount += ($item->price_pro*$Newdiscount);
                                            ?>
												{{ number_format($totalAmount) }} VNĐ
												<span style="text-decoration: line-through;">{{ number_format($item->price_pro) }} VNĐ</span>
											</div>
											<div class="product_name"><div><a href='{{ url("product/$item->id") }}'>{{ $item->name_pro }}</a></div></div>

											<div class="product_extras">
												<!-- <div class="product_color">
													<input type="radio" checked name="product_color" style="background:#b19c83">
													<input type="radio" name="product_color" style="background:#000000">
													<input type="radio" name="product_color" style="background:#999999">
												</div> -->
												<a href="{{ url('cart/add/'. $item->id ) }}">
													<button class="product_cart_button">Mua ngay</button>
												</a>
											</div>
										</div>
										<!-- <div class="product_fav"><i class="fas fa-heart"></i></div> -->
										<ul class="product_marks">
											<li class="product_mark product_discount">-{{ $item->discount_pro }}%</li>
											<li class="product_mark product_new">new</li>
										</ul>
									</div>
								</div>
							@endforeach

							</div>
							<div class="featured_slider_dots_cover"></div>
						</div>

						<!-- Product Panel  Bán chạy -->

						<div class="product_panel panel">
							<div class="featured_slider slider">
						
								<!-- Slider Item -->
							@foreach($products_hot_sell as $item)
								<div class="featured_slider_item">
									<div class="border_active"></div>
									<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
										<div class="product_image d-flex flex-column align-items-center justify-content-center">
											<a href='{{ url("product/$item->id") }}'>
												<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" style="height: 100px;" alt="">
											</a>
										</div>
										<div class="product_content">
											<div class="product_price discount">
												<?php 
	                                                $totalAmount = 0; 
	                                                $Newdiscount = (100-$item->discount_pro)/100;
	                                                $totalAmount += ($item->price_pro*$Newdiscount);
	                                            ?>
												{{ number_format($totalAmount) }} VNĐ
												<span style="text-decoration: line-through;">{{ number_format($item->price_pro) }} VNĐ</span>
											</div>
											<div class="product_name"><div><a href="{{ url('product/'. $item->id ) }}">{{ $item->name_pro }}</a></div></div>
											<div class="product_extras">
												<!-- <div class="product_color">
													<input type="radio" checked name="product_color" style="background:#b19c83">
													<input type="radio" name="product_color" style="background:#000000">
													<input type="radio" name="product_color" style="background:#999999">
												</div> -->
												<a href="{{ url('cart/add/'. $item->id ) }}">
													<button class="product_cart_button">Mua ngay</button>
												</a>
											</div>
										</div>
										<!-- <div class="product_fav"><i class="fas fa-heart"></i></div> -->
										<ul class="product_marks">
											<li class="product_mark product_discount">-{{ $item->discount_pro }}%</li>
											<li class="product_mark product_new">new</li>
										</ul>
									</div>
								</div>
							@endforeach
								

							</div>
							<div class="featured_slider_dots_cover"></div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- Popular Categories -->

<!-- <div class="popular_categories">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="popular_categories_content">
					<div class="popular_categories_title">Popular Categories</div>
					<div class="popular_categories_slider_nav">
						<div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
						<div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
					</div>
					<div class="popular_categories_link"><a href="#">full catalog</a></div>
				</div>
			</div>
			
			Popular Categories Slider

			<div class="col-lg-9">
				<div class="popular_categories_slider_container">
					<div class="owl-carousel owl-theme popular_categories_slider">

						Popular Categories Item
						<div class="owl-item">
							<div class="popular_category d-flex flex-column align-items-center justify-content-center">
								<div class="popular_category_image"><img src="images/popular_1.png" alt=""></div>
								<div class="popular_category_text">Smartphones & Tablets</div>
							</div>
						</div>

						Popular Categories Item
						<div class="owl-item">
							<div class="popular_category d-flex flex-column align-items-center justify-content-center">
								<div class="popular_category_image"><img src="images/popular_2.png" alt=""></div>
								<div class="popular_category_text">Computers & Laptops</div>
							</div>
						</div>

						Popular Categories Item
						<div class="owl-item">
							<div class="popular_category d-flex flex-column align-items-center justify-content-center">
								<div class="popular_category_image"><img src="images/popular_3.png" alt=""></div>
								<div class="popular_category_text">Gadgets</div>
							</div>
						</div>

						Popular Categories Item
						<div class="owl-item">
							<div class="popular_category d-flex flex-column align-items-center justify-content-center">
								<div class="popular_category_image"><img src="images/popular_4.png" alt=""></div>
								<div class="popular_category_text">Video Games & Consoles</div>
							</div>
						</div>

						Popular Categories Item
						<div class="owl-item">
							<div class="popular_category d-flex flex-column align-items-center justify-content-center">
								<div class="popular_category_image"><img src="images/popular_5.png" alt=""></div>
								<div class="popular_category_text">Accessories</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->

<!-- Banner -->

<div class="banner_2">
	<div class="banner_2_background" style="background-image:url(images/banner_2_background.jpg)"></div>
	<div class="banner_2_container">
		<div class="banner_2_dots"></div>
		<!-- Banner 2 Slider -->

		<div class="owl-carousel owl-theme banner_2_slider">

			<!-- Banner 2 Slider Item -->
		@foreach($new_product as $item)
			<div class="owl-item">
				<div class="banner_2_item">
					<div class="container fill_height">
						<div class="row fill_height">
							<div class="col-lg-4 col-md-6 fill_height">
								<div class="banner_2_content">
									<div class="banner_2_category">
										<a href='{{ url("shop/$item->idTrade") }}'>{{ $item->trade->name_trade }}</a>
									</div>
									<div class="banner_2_title">{{ $item->name_pro }}</div>
									<div class="banner_2_text">Sản phẩm mới nhất của hệ thống</div>
									<div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
									<div class="button banner_2_button"><a href='{{ url("product/$item->id") }}'>Chi tiết</a></div>
								</div>
								
							</div>
							<div class="col-lg-8 col-md-6 fill_height">
								<div class="banner_2_image_container">
									<div class="banner_2_image">
										<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" style="height: 300px; width: 30%;" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>			
				</div>
			</div>
			@endforeach

			

		</div>
	</div>
</div>

<!-- Hot New Arrivals -->

<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="tabbed_container">
					<div class="tabs clearfix tabs-right">
						<div class="new_arrivals_title">Thương hiệu nổi bật</div>
						<ul class="clearfix">
							<li class="active">Epos Swiss</li>
							<li>Atlantic Atlantic Swiss</li>
							<li>Diamond D </li>
						</ul>
						<div class="tabs_line"><span></span></div>
					</div>
					<div class="row">
						<div class="col-lg-12" style="z-index:1;">

							<!-- Product Panel -->
							<div class="product_panel panel active">
								<div class="arrivals_slider slider">

									<!-- Slider Item -->
								@foreach($trade_1 as $item)
									<div class="arrivals_slider_item">
										<div class="border_active"></div>
										<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center">
												<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" style="height: 110px; width: 30%;" alt="">
											</div>
											<div class="product_content">
									<?php 
		                                $totalAmount = 0; 
		                                $Newdiscount = (100-$item->discount_pro)/100;
		                                $totalAmount += ($item->price_pro*$Newdiscount);
		                            ?>
												<div class="product_price">{{ number_format($totalAmount) }} VNĐ</div>
												<div class="product_name"><div><a href='{{ url("product/$item->id") }}'>{{ $item->name_pro }}</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">
														<a href='{{ url("product/$item->id") }}' style="color: white;">Chi tiết</a>
													</button>
												</div>
											</div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">-{{ $item->discount_pro }}%</li>
											</ul>
										</div>
									</div>
								@endforeach
									
								</div>
								<div class="arrivals_slider_dots_cover"></div>
							</div>

							<!-- Product Panel -->
							<div class="product_panel panel">
								<div class="arrivals_slider slider">

									<!-- Slider Item -->
								@foreach($trade_2 as $item)
									<div class="arrivals_slider_item">
										<div class="border_active"></div>
										<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center">
												<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" style="height: 110px; width: 30%;" alt="">
											</div>
											<div class="product_content">
									<?php 
		                                $totalAmount = 0; 
		                                $Newdiscount = (100-$item->discount_pro)/100;
		                                $totalAmount += ($item->price_pro*$Newdiscount);
		                            ?>
												<div class="product_price">
													{{ number_format($totalAmount) }} VNĐ
												</div>
												<div class="product_name"><div><a href='{{ url("product/$item->id") }}'>{{ $item->name_pro }}</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">
														<a href='{{ url("product/$item->id") }}' style="color: white;">Chi tiết</a>
													</button>
												</div>
											</div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">-{{ $item->discount_pro }}%</li>
											</ul>
										</div>
									</div>
								@endforeach

									
								</div>
								<div class="arrivals_slider_dots_cover"></div>
							</div>

							<!-- Product Panel -->
							<div class="product_panel panel">
								<div class="arrivals_slider slider">

									<!-- Slider Item -->
								@foreach($trade_3 as $item)
									<div class="arrivals_slider_item">
										<div class="border_active"></div>
										<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
											<div class="product_image d-flex flex-column align-items-center justify-content-center">
												<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" style="height: 110px; width: 30%;" alt="">
											</div>
											<div class="product_content">
									<?php 
		                                $totalAmount = 0; 
		                                $Newdiscount = (100-$item->discount_pro)/100;
		                                $totalAmount += ($item->price_pro*$Newdiscount);
		                            ?>
												<div class="product_price">
													{{ number_format($totalAmount) }} VNĐ
												</div>
												<div class="product_name"><div><a href='{{ url("product/$item->id") }}'>{{ $item->name_pro }}</a></div></div>
												<div class="product_extras">
													<div class="product_color">
														<input type="radio" checked name="product_color" style="background:#b19c83">
														<input type="radio" name="product_color" style="background:#000000">
														<input type="radio" name="product_color" style="background:#999999">
													</div>
													<button class="product_cart_button">
														<a href='{{ url("product/$item->id") }}' style="color: white;">Chi tiết</a>
													</button>
												</div>
											</div>
											<ul class="product_marks">
												<li class="product_mark product_discount"></li>
												<li class="product_mark product_new">-{{ $item->discount_pro }}%</li>
											</ul>
										</div>
									</div>
								@endforeach

									
								</div>
								<div class="arrivals_slider_dots_cover"></div>
							</div>

						</div>

						<!-- <div class="col-lg-3">
							<div class="arrivals_single clearfix">
								<div class="d-flex flex-column align-items-center justify-content-center">
									<div class="arrivals_single_image"><img src="images/new_single.png" alt=""></div>
									<div class="arrivals_single_content">
										<div class="arrivals_single_category"><a href="#">Smartphones</a></div>
										<div class="arrivals_single_name_container clearfix">
											<div class="arrivals_single_name"><a href="#">LUNA Smartphone</a></div>
											<div class="arrivals_single_price text-right">$379</div>
										</div>
										<div class="rating_r rating_r_4 arrivals_single_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<form action="#"><button class="arrivals_single_button">Add to Cart</button></form>
									</div>
									<div class="arrivals_single_fav product_fav active"><i class="fas fa-heart"></i></div>
									<ul class="arrivals_single_marks product_marks">
										<li class="arrivals_single_mark product_mark product_new">new</li>
									</ul>
								</div>
							</div>
						</div> -->

					</div>
							
				</div>
			</div>
		</div>
	</div>		
</div>

<!-- Best Sellers -->

<!--   day nhé  -->


<!-- Adverts -->

<!-- <div class="adverts">
	<div class="container">
		<div class="row">

			<div class="col-lg-4 advert_col">
				
				Advert Item

				<div class="advert d-flex flex-row align-items-center justify-content-start">
					<div class="advert_content">
						<div class="advert_title"><a href="#">HOT Trends</a></div>
						<div class="advert_text">Các sản phẩm xu hướng hiện tại</div>
					</div>
					<div class="ml-auto"><div class="advert_image"><img src="{{ url('images/adv_1.png') }}" alt=""></div></div>
				</div>
			</div>

			<div class="col-lg-4 advert_col">
				
				Advert Item

				<div class="advert d-flex flex-row align-items-center justify-content-start">
					<div class="advert_content">
						<div class="advert_subtitle">HOT Trends</div>
						<div class="advert_title_2"><a href="#">Sale -45%</a></div>
						<div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
					</div>
					<div class="ml-auto"><div class="advert_image"><img src="{{ url('images/adv_2.png') }}" alt=""></div></div>
				</div>
			</div>

			<div class="col-lg-4 advert_col">
				
				Advert Item

				<div class="advert d-flex flex-row align-items-center justify-content-start">
					<div class="advert_content">
						<div class="advert_title"><a href="#">Trends 2018</a></div>
						<div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
					</div>
					<div class="ml-auto"><div class="advert_image"><img src="{{ url('images/adv_3.png') }}" alt=""></div></div>
				</div>
			</div>

		</div>
	</div>
</div> -->

<!-- Trends -->

<div class="trends">
	<div class="trends_background" style="background-image:url(images/trends_background.jpg)"></div>
	<div class="trends_overlay"></div>
	<div class="container">
		<div class="row">

			<!-- Trends Content -->
			<div class="col-lg-3">
				<div class="trends_container">
					<h2 class="trends_title">HOT Trends</h2>
					<div class="trends_text"><p>Các sản phẩm xu hướng hiện tại</p></div>
					<div class="trends_slider_nav">
						<div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
						<div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
					</div>
				</div>
			</div>

			<!-- Trends Slider -->
			<div class="col-lg-9">
				<div class="trends_slider_container">

					<!-- Trends Slider -->

					<div class="owl-carousel owl-theme trends_slider">

						<!-- Trends Slider Item -->
					@foreach($product_Noibat as $item)
						<div class="owl-item">
							<div class="trends_item is_new">
								<div class="trends_image d-flex flex-column align-items-center justify-content-center">
									<a href='{{ url("product/$item->id") }}'>
										<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" style="height: 200px;" alt="">
									</a>
								</div>
								<div class="trends_content">
									<div class="trends_category"><a href="#">{{ $item->trade->name_trade }}</a></div>
									<div class="trends_info clearfix">
										<div class="trends_name"><a href='{{ url("product/$item->id") }}'>{{ $item->name_pro }}</a></div>
										<!-- <div class="trends_price">$379</div> -->
									</div>
								</div>
								<ul class="trends_marks">
									<li class="trends_mark trends_discount"></li>
									<li class="trends_mark trends_new">new</li>
								</ul>
								
							</div>
						</div>
					@endforeach

					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Reviews -->

<!-- <div class="reviews">
	<div class="container">
		<div class="row">
			<div class="col">
				
				<div class="reviews_title_container">
					<h3 class="reviews_title">Latest Reviews</h3>
					<div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
				</div>

				<div class="reviews_slider_container">
					
					Reviews Slider
					<div class="owl-carousel owl-theme reviews_slider">
						
						Reviews Slider Item
						<div class="owl-item">
							<div class="review d-flex flex-row align-items-start justify-content-start">
								<div><div class="review_image"><img src="images/review_1.jpg" alt=""></div></div>
								<div class="review_content">
									<div class="review_name">Roberto Sanchez</div>
									<div class="review_rating_container">
										<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="review_time">2 day ago</div>
									</div>
									<div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
								</div>
							</div>
						</div>

						Reviews Slider Item
						<div class="owl-item">
							<div class="review d-flex flex-row align-items-start justify-content-start">
								<div><div class="review_image"><img src="images/review_2.jpg" alt=""></div></div>
								<div class="review_content">
									<div class="review_name">Brandon Flowers</div>
									<div class="review_rating_container">
										<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="review_time">2 day ago</div>
									</div>
									<div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
								</div>
							</div>
						</div>

						Reviews Slider Item
						<div class="owl-item">
							<div class="review d-flex flex-row align-items-start justify-content-start">
								<div><div class="review_image"><img src="images/review_3.jpg" alt=""></div></div>
								<div class="review_content">
									<div class="review_name">Emilia Clarke</div>
									<div class="review_rating_container">
										<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="review_time">2 day ago</div>
									</div>
									<div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
								</div>
							</div>
						</div>

						Reviews Slider Item
						<div class="owl-item">
							<div class="review d-flex flex-row align-items-start justify-content-start">
								<div><div class="review_image"><img src="images/review_1.jpg" alt=""></div></div>
								<div class="review_content">
									<div class="review_name">Roberto Sanchez</div>
									<div class="review_rating_container">
										<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="review_time">2 day ago</div>
									</div>
									<div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
								</div>
							</div>
						</div>

						Reviews Slider Item
						<div class="owl-item">
							<div class="review d-flex flex-row align-items-start justify-content-start">
								<div><div class="review_image"><img src="images/review_2.jpg" alt=""></div></div>
								<div class="review_content">
									<div class="review_name">Brandon Flowers</div>
									<div class="review_rating_container">
										<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="review_time">2 day ago</div>
									</div>
									<div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
								</div>
							</div>
						</div>

						Reviews Slider Item
						<div class="owl-item">
							<div class="review d-flex flex-row align-items-start justify-content-start">
								<div><div class="review_image"><img src="images/review_3.jpg" alt=""></div></div>
								<div class="review_content">
									<div class="review_name">Emilia Clarke</div>
									<div class="review_rating_container">
										<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
										<div class="review_time">2 day ago</div>
									</div>
									<div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
								</div>
							</div>
						</div>

					</div>
					<div class="reviews_dots"></div>
				</div>
			</div>
		</div>
	</div>
</div>

Recently Viewed

<div class="viewed">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="viewed_title_container">
					<h3 class="viewed_title">Recently Viewed</h3>
					<div class="viewed_nav_container">
						<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
					</div>
				</div>

				<div class="viewed_slider_container">
					
					Recently Viewed Slider

					<div class="owl-carousel owl-theme viewed_slider">
						
						Recently Viewed Item
						<div class="owl-item">
							<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
								<div class="viewed_image"><img src="images/view_1.jpg" alt=""></div>
								<div class="viewed_content text-center">
									<div class="viewed_price">$225<span>$300</span></div>
									<div class="viewed_name"><a href="#">Beoplay H7</a></div>
								</div>
								<ul class="item_marks">
									<li class="item_mark item_discount">-25%</li>
									<li class="item_mark item_new">new</li>
								</ul>
							</div>
						</div>

						Recently Viewed Item
						<div class="owl-item">
							<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
								<div class="viewed_image"><img src="images/view_2.jpg" alt=""></div>
								<div class="viewed_content text-center">
									<div class="viewed_price">$379</div>
									<div class="viewed_name"><a href="#">LUNA Smartphone</a></div>
								</div>
								<ul class="item_marks">
									<li class="item_mark item_discount">-25%</li>
									<li class="item_mark item_new">new</li>
								</ul>
							</div>
						</div>

						Recently Viewed Item
						<div class="owl-item">
							<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
								<div class="viewed_image"><img src="images/view_3.jpg" alt=""></div>
								<div class="viewed_content text-center">
									<div class="viewed_price">$225</div>
									<div class="viewed_name"><a href="#">Samsung J730F...</a></div>
								</div>
								<ul class="item_marks">
									<li class="item_mark item_discount">-25%</li>
									<li class="item_mark item_new">new</li>
								</ul>
							</div>
						</div>

						Recently Viewed Item
						<div class="owl-item">
							<div class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
								<div class="viewed_image"><img src="images/view_4.jpg" alt=""></div>
								<div class="viewed_content text-center">
									<div class="viewed_price">$379</div>
									<div class="viewed_name"><a href="#">Huawei MediaPad...</a></div>
								</div>
								<ul class="item_marks">
									<li class="item_mark item_discount">-25%</li>
									<li class="item_mark item_new">new</li>
								</ul>
							</div>
						</div>

						Recently Viewed Item
						<div class="owl-item">
							<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
								<div class="viewed_image"><img src="images/view_5.jpg" alt=""></div>
								<div class="viewed_content text-center">
									<div class="viewed_price">$225<span>$300</span></div>
									<div class="viewed_name"><a href="#">Sony PS4 Slim</a></div>
								</div>
								<ul class="item_marks">
									<li class="item_mark item_discount">-25%</li>
									<li class="item_mark item_new">new</li>
								</ul>
							</div>
						</div>

						Recently Viewed Item
						<div class="owl-item">
							<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
								<div class="viewed_image"><img src="images/view_6.jpg" alt=""></div>
								<div class="viewed_content text-center">
									<div class="viewed_price">$375</div>
									<div class="viewed_name"><a href="#">Speedlink...</a></div>
								</div>
								<ul class="item_marks">
									<li class="item_mark item_discount">-25%</li>
									<li class="item_mark item_new">new</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->

<!-- Brands -->

<div class="brands">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="brands_slider_container">
					
					<!-- Brands Slider -->

					<div class="owl-carousel owl-theme brands_slider">
						
					@foreach($tradeAll as $itemCate)
						<div class="owl-item">
							<div class="brands_item d-flex flex-column justify-content-center">
								<a href='{{ url("shop/$itemCate->id") }}'>
									<img src="{{ url('upload/trade/' .$itemCate->avt_trade) }}" style="height: 100px; width: 100px;" alt="">
								</a>
							</div>
						</div>
					@endforeach

					</div>
					
					<!-- Brands Slider Navigation -->
					<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
					<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection