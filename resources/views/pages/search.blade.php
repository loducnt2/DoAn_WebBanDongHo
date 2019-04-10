@extends('layouts.index')

@section('tieude')
	Sản phẩm tìm kiếm
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/shop_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/shop_responsive.css') }}">
@endsection

@section('content')
<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title" style="font-family: arial; font-weight: bold;">Danh sách sản phẩm</h2>
		</div>
	</div>

	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Danh mục sản phẩm</div>
							<ul class="sidebar_categories">
							@foreach($cate as $item)
								@if(count($item->trade) > 0)
								<li><a href="#">{{ $item->name_cate }}</a></li>
								<ul>
			                        @foreach($item->trade as $tra)
		                    		<li class="list-group-item">
			     						<a href='{{ url("shop/$tra->id") }}'>{{ $tra->name_trade }}</a>
		                    		</li>
			                        @endforeach 
			                    </ul>
								@endif
			                @endforeach
							</ul>
						</div>
						<!-- <div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="filter_price">
								<div id="slider-range" class="slider_range"></div>
								<p>Range: </p>
								<p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
							</div>
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle color_subtitle">Color</div>
							<ul class="colors_list">
								<li class="color"><a href="#" style="background: #b19c83;"></a></li>
								<li class="color"><a href="#" style="background: #000000;"></a></li>
								<li class="color"><a href="#" style="background: #999999;"></a></li>
								<li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
								<li class="color"><a href="#" style="background: #df3b3b;"></a></li>
								<li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
							</ul>
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Brands</div>
							<ul class="brands_list">
								<li class="brand"><a href="#">Apple</a></li>
								<li class="brand"><a href="#">Beoplay</a></li>
								<li class="brand"><a href="#">Google</a></li>
								<li class="brand"><a href="#">Meizu</a></li>
								<li class="brand"><a href="#">OnePlus</a></li>
								<li class="brand"><a href="#">Samsung</a></li>
								<li class="brand"><a href="#">Sony</a></li>
								<li class="brand"><a href="#">Xiaomi</a></li>
							</ul>
						</div> -->
					</div>

					

				</div>

				<div class="col-lg-9">
					
					<!-- Shop Content -->
					
	
					<div class="shop_content">
						<div class="shop_bar clearfix">
						<?php $dem=0 ?>
						@foreach($pro_search as $item)
							<?php $dem++; ?>
						@endforeach
							<div class="shop_product_count"><span><?php echo $dem; ?> </span>&nbsp; {{ $keyword }}</div>
						
							<!-- <div class="shop_sorting">
								<span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
										<ul>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
											<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
										</ul>
									</li>
								</ul>
							</div> -->
						</div>
					

<!-- CONTENT đây nhá -->
						<div class="product_grid">
							<div class="product_grid_border"></div>

							<!-- Product Item -->
						
						@foreach($pro_search as $item)
							<!-- Product Item -->
							<div class="product_item discount">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center">
									<a href='{{ url("product/$item->id") }}'>
										<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" alt="" style="height: 100px;">
									</a>
								</div>
								<div class="product_content">
									<div class="product_price">
									<?php 
                                        $totalAmount = 0; 
                                        $Newdiscount = (100-$item->discount_pro)/100;
                                        $totalAmount += ($item->price_pro*$Newdiscount);
                                    ?>
										{{ number_format($totalAmount) }} VNĐ
										<span style="text-decoration: line-through;">{{ number_format($item->price_pro) }} VNĐ</span>
									</div>
									<div class="product_name">
										<div><a href='{{ url("product/$item->id") }}' tabindex="0">{{ $item->name_pro }}</a></div>
									</div>
								</div>
								<!-- <div class="product_fav"><i class="fas fa-heart"></i></div> -->
								<ul class="product_marks">
									<li class="product_mark product_discount">-{{ $item->discount_pro }}%</li>
									<!-- <li class="product_mark product_new">new</li> -->
								</ul>
							</div>
						@endforeach
						</div>

						<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row">
							{{ $pro_search->links() }}
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Các sản phẩm gợi ý</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">
						
						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">
							
							<!-- Recently Viewed Item -->
						@foreach($pro_relative_search as $item)
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image">
										<a href='{{ url("product/$item->id") }}'>
											<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" style="width: 100px; height: 130px;" alt="">
										</a>
									</div>
									<?php 
		                                $totalAmount1 = 0; 
		                                $Newdiscount1 = (100-$item->discount_pro)/100;
		                                $totalAmount1 += ($item->price_pro*$Newdiscount1);
		                            ?>
									<div class="viewed_content text-center">
										<div class="viewed_price">{{ number_format($totalAmount1) }} VNĐ
											<span>{{ number_format($item->price_pro) }} VNĐ</span>
										</div>
										<div class="viewed_name"><a href='{{ url("product/$item->id") }}'>{{ $item->name_pro }}</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">- {{ $item->discount_pro }} %</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>
						@endforeach

							

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Brands -->

	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="brands_slider_container">
						
						<!-- Brands Slider -->

						<div class="owl-carousel owl-theme brands_slider">
						@foreach($tra_relative_search as $item)
							<div class="owl-item">
								<div class="brands_item d-flex flex-column justify-content-center">
									<a href='{{ url("shop/$item->id") }}'>
										<img src="{{ url('upload/trade/' .$item->avt_trade) }}" style="height: 100px; width: 100px;" alt="">
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

@section('script')
	<script src="{{ asset('plugins/Isotope/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
	<script src="{{ asset('plugins/parallax-js-master/parallax.min.js') }}"></script>
	<script src="{{ asset('js/shop_custom.js') }}"></script>
@endsection