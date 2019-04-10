@extends('layouts.index')

@section('tieude')
	Sản phẩm
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/product_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/product_responsive.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/client.css') }}">
@endsection

@section('content')
<!-- Single Product -->



<div class="single_product">
	<div class="container">

	@if(session('success'))
	    <div class="alert alert-success">
	        {{ session('success') }}
	    </div>
	@endif

		<div class="row">
			<!-- Images -->
			<div class="col-lg-2 order-lg-1 order-2">
				<ul class="image_list">
				@foreach($img_pro as $img)
					<li data-image="{{ url('upload/image/' .$img->img) }}">
						<img src="{{ url('upload/image/' .$img->img) }}" alt="">
					</li>
				@endforeach
				</ul>
			</div>

			<!-- Selected Image -->
			<div class="col-lg-5 order-lg-2 order-1">
				<div class="image_selected"><img src="{{ url('upload/product/' .$pro_pro->thumbnail_pro) }}" alt=""></div>
			</div>

			<!-- Description -->
			<div class="col-lg-5 order-3">
				<div class="product_description">
					<div class="product_category">{{ $pro_pro->trade->name_trade }}</div>
					<div class="product_name">{{ $pro_pro->name_pro }}</div>
					<div class="rating_r rating_r_4 product_rating">
						<!-- <i></i><i></i><i></i><i></i><i></i> -->
					</div>
					<div class="product_text">
						<p>{!! $pro_pro->description_pro !!}</p>
					</div>
					<div class="order_info d-flex flex-row">
						<form action="">
							<div class="clearfix" style="z-index: 1000;">

								<!-- Product Quantity
								<div class="product_quantity clearfix">
									<span>Quantity: </span>
									<input id="quantity_input" type="text" pattern="[0-9]*" value="1">
									<div class="quantity_buttons">
										<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
										<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
									</div>
								</div>
								
								Product Color
								<ul class="product_color">
									<li>
										<span>Color: </span>
										<div class="color_mark_container"><div id="selected_color" class="color_mark"></div></div>
										<div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>
								
										<ul class="color_list">
											<li><div class="color_mark" style="background: #999999;"></div></li>
											<li><div class="color_mark" style="background: #b19c83;"></div></li>
											<li><div class="color_mark" style="background: #000000;"></div></li>
										</ul>
									</li>
								</ul> -->

							</div>

							
							
							<?php 
                                $totalAmount = 0; 
                                $Newdiscount = (100-$pro_pro->discount_pro)/100;
                                $totalAmount += ($pro_pro->price_pro*$Newdiscount);
                            ?>
							<div class="product_price">{{ number_format($totalAmount) }} VNĐ</div>
								<span style="text-decoration: line-through;">{{ number_format($pro_pro->price_pro) }} VNĐ</span>

							<div class="button_container">
								<button type="button" class="button cart_button">
									<a href="{{ url('cart/add/'. $pro_pro->id ) }}">Thêm vào giỏ hàng</a>
								</button>
								<div class="product_fav"><i class="fas fa-heart"></i></div>
							</div>
							
						</form>
					</div>
				</div>
			</div>

		</div>
		<!-- <div class="row">
			Phần mô tả
		</div> -->
	</div>
	

	<div class="container" style="margin-top: 50px;">
		<h4>Bình luận sản phẩm</h4>
			@if(count($errors) > 0)
		        <ul>
		            @foreach($errors->all() as $err)
		                <li style="color: red; text-decoration: none;">{{ $err }}</li>
		            @endforeach
		        </ul>
		    @endif
		    
		    @if(session('notify'))
		        <p style="color: blue;">{{ session('notify') }}</p>
		    @endif

		    @if(session('errorNotify'))
		        <p style="color: red;">{{ session('errorNotify') }}</p>
		    @endif

		<form action="{{ url('comment/'.$pro_pro->id) }}" method="POST">
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group" style="width: 50%;">
                    <textarea class="form-control" name="content_cmt" rows="3"></textarea>
                </div>
		    <button type="submit" class="btn btn-info" style="cursor: pointer;">Gửi</button>
		</form>
	</div>


	<!-- Comment -->
	<div class="container" style="margin-top: 50px;">
		<h4>Danh sách bình luận</h4>
		@foreach($pro_pro->cmt as $item)
	   		<div class="cud_media">
	           <div>
		           	<a class="cud_pull-left" href="#">
		                <img width="70px" height="70px" src="{{  url('upload/user/'.$item->user->avatar ) }}" alt="">
		            </a>
	           </div>
	            <div class="cud_media-body">
	                <div class="cud_media_body_header">
	                	<div>
		                	<h4 class="cud_media-heading">{{ $item->user->name }}
			                    <small>{{ $item->created_at }}</small>
			                </h4>
		                </div>
		                <div>
		                	{{ $item->content_cmt }}
		                </div>
		                <div>
		            		<a href="#">Trả lời</a>
		            	</div>
			            	@foreach($item->listComment as $itemList)
				            	<div class="cud_media rep_cud_media">
						           <div>
							           	<a class="cud_pull-left" href="#">
							                <img width="70px" height="70px" src="{{  url('upload/user/'.$itemList->user->avatar ) }}" alt="">
							            </a>
						           </div>
						            <div class="cud_media-body">
						                <div>
						                	<div>
							                	<h4 class="cud_media-heading">
								                    <small>{{ $itemList->created_at }}</small>
								                </h4>
							                </div>
							                <div>
							                	{{ $itemList->content }}
							                </div>
						                </div>
						            </div>
						        </div>
						    @endforeach
	                </div>
	                <div style="padding-left: 20px;">
	                	<form action="{{ url('list-comment/'.$pro_pro->id.'/'.$item->id) }}" method="POST">
						    <input type="hidden" name="_token" value="{{ csrf_token() }}">
				                <div class="form-group" style="width: 50%;">
				                    <textarea class="form-control" name="content" rows="3"></textarea>
				                </div>
						    <button type="submit" class="btn btn-info" style="cursor: pointer;">Trả lời</button>
						</form>
	                </div>
	            </div>
	        </div>
		@endforeach
	</div>
    <!-- Comment -->

</div>

<!-- Recently Viewed -->

<div class="viewed">
	<div class="container">
		
		<div class="row">
			<div class="col">
				<div class="viewed_title_container">
					<h3 class="viewed_title">Các sản phẩm liên quan</h3>
					<div class="viewed_nav_container">
						<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
					</div>
				</div>

				<div class="viewed_slider_container">
					
					<!-- Recently Viewed Slider -->

					<div class="owl-carousel owl-theme viewed_slider">
						
						<!-- Recently Viewed Item -->
					

					@if(isset($relative_pro))
						@foreach($relative_pro as $item)
						<div class="owl-item">
							<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
								<div class="viewed_image">
									<a href='{{ url("product/$item->id") }}'>
										<img src="{{ url('upload/product/' .$item->thumbnail_pro) }}" alt="">
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
					@endif
					</div>

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
					@foreach($trade as $item)
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
	<script src="{{ asset('js/product_custom.js') }}"></script>
@endsection