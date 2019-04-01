@extends('layouts.index')

@section('tieude')
	Giỏ hàng
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
						<div class="cart_title">Giỏ hàng</div>
					
					<?php $totalAmount = 0; ?>
					@foreach(Cart::content() as $item)
					<form method="POST" action="{{ url('cart/' .$item->rowId) }}">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="cart_items">
							<ul class="cart_list">
							
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
												<input class="txtSoluong" name="SoLuongMoi" type="number" style="width: 70px;" value="{{ $item->qty }}" name="">
												<input type="hidden" name="IdCart" value="{{ $item->rowId }}"> 
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
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Sửa</div>
											<div class="cart_item_text">
												<input type="submit" name="" value="Cập nhật">
											</div>
										</div>
									</div>
								</li>
							

							</ul>
						</div>
					@endforeach
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Tổng tiền:</div>
								<div class="order_total_amount">{{ number_format($totalAmount) }} VND</div>
							</div>
						</div>

						<div class="cart_buttons">
						@if(Auth::check())
						<?php $id = Auth::user()->id; ?>
							<a style="padding-right: 20px;" href="{{ url('cart/order/'.$id) }}">
								Theo dõi đơn hàng
							</a>
						@endif
							
							<a href="{{ url('home') }}">
								<button type="button" class="button cart_button_clear" action="">Trang chủ</button>
							</a>
							<a href="{{ url('cart/destroy') }}">
								<button type="button" class="button cart_button_clear" style="background: #fff3cd; color: black;" action="">Xóa hết</button>
							</a>
							<a href="{{ url('cart/checkout') }}">
								<button type="button" class="button cart_button_checkout">Tiếp tục</button>
							</a>
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{ asset('js/cart_custom.js') }}"></script>
	<!-- <script>
		$(document).ready(function(){
			$(".updatecart").click(function(){
				var rowid = $(this).attr('id');
				var qty = $(this).parent().parent().parent().find(".txtSoluong").val();
				var token = $("input[name='_token']").val();
				//alert(qty);
	
				$.ajax({
					url:'cart/'+rowid+'/'+qty,
					type:'GET',
					cache:false,
					data:{"_token":token, "id":rowid, "qty":qty},
					success: function(data){
						if (data == "string") {
							alert("adasd");
						}
						//window.location = "cart";
					}
				});
			});
		});
	</script> -->
@endsection