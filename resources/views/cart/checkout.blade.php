@extends('layouts.index')

@section('tieude')
	Thanh toán đặt hàng
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_responsive.css') }}">
@endsection

@section('content')
	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Sản phẩm</div>
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
										 <img src='{{ url("upload/product/" .$item->options->thumbnail_pro) }}' width="100px" height="100px" width="50px" height="50px"> 
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
												<input type="text" style="width: 70px;" value="{{ $item->qty }}" name="">
											</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Khuyến mại</div>
											<div class="cart_item_text">{{ number_format($item->options->discount_pro) }}</div>
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
							<h2 style="margin-top: 50px;">Thông tin giao hàng</h2>
						</div>
						<div class="cart_items">
							<form action="{{ url('cart/checkout') }}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							    <div class="form-group">
							    	<label for="delivery_phone">Số điện thoại nhận hàng:</label>
							    	<input type="text" name="delivery_phone" value="{{ Auth::user()->phone }}" class="form-control" style="color: black;">
							    </div>
							    <div class="form-group">
							    	<label for="delivery_address">Địa chỉ giao hàng:</label>
							    	<input type="text" name="delivery_address" value="{{ Auth::user()->address }}" class="form-control" style="color: black;" >
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
@endsection

@section('script')
	<script src="{{ asset('js/cart_custom.js') }}"></script>
@endsection