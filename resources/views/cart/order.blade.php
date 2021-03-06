@extends('layouts.index')

@section('tieude')
	Thông tin đơn hàng
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_responsive.css') }}">
@endsection

@section('content')
	<div class="cart_section">
		<div class="container">
			<div class="row">
				{{--Báo phần đặt hàng xong--}}
			    @if(Session::has('success'))
			        <div class="alert alert-success">{{session('success')}}</div>
			    @endif
			</div>
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					
					<!-- @foreach($orders as $key => $count)
						<p>Đơn hàng thứ: {{ $key+1 }}</p>
					@endforeach -->
				
					
					
					<?php $dem=0; ?>
					@foreach($orders as $item)
						<?php $dem++; ?>
					<div class="cart_container">
						<div class="cart_title" style="font-family: arial; font-weight: bold;  font-size: 22px;">Đơn hàng <?php echo $dem; ?> gồm: </div>
						<div class="cart_items">
							<ul class="cart_list">

							@foreach($item->orderdetail as $detail)
								<li class="cart_item clearfix">
									<div class="cart_item_image">
										<?php $anh = $detail->product->thumbnail_pro ?>
										<img src='{{ url("upload/product/$anh") }}' width="100px" height="100px" width="50px" height="50px">
									</div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Tên sản phẩm</div>
											<div class="cart_item_text">{{ $detail->product->name_pro }}</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Số lượng</div>
											<div class="cart_item_text">
												{{ $detail->product->quantity_pro }}
											</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Đơn giá</div>
											<div class="cart_item_text">
												{{ $detail->price }}
											</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Khuyến mại</div>
											<div class="cart_item_text">
												{{ $detail->discount }}%
											</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Thành tiền</div>
											<div class="cart_item_text">
												<?php 
						                            $totalAmount = 0; 
						                        ?>
						                            <?php 
						                                $Newdiscount = (100-$detail->discount)/100;
						                                $totalAmount += ($detail->quantity*$detail->price*$Newdiscount);
						                             ?>
					                            {{ number_format($totalAmount) }}
											</div>
										</div>
										
									</div>
								</li>
							@endforeach
							</ul>
						</div>
					</div>

					<div class="cart_container" style="margin-bottom: 50px;">
						<div class="cart_title" style="font-family: arial; font-weight: bold; font-size: 20px;">Cập nhật hóa đơn: <?php echo $dem; ?> </div>
						<div class="cart_items" style="margin-top: 10px !important;">
							<ul class="cart_list">
								<li class="cart_item clearfix">
									<div class="cart_item_image">
									</div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Tên khách hàng</div>
											<div class="cart_item_text">{{ $item->name }}</div>
										</div>
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Tổng tiền</div>
											<div class="cart_item_text">
                                                {{ number_format($item->total) }}
											</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Tình trạng</div>
											<div class="cart_item_text">
												@if($item->status_order == 0)
                                                    {{"Đã hoàn thành"}}  
                                                @endif
                                                @if($item->status_order == 1)
                                                    {{"Đang xử lý"}} 
                                                @endif
                                                @if($item->status_order == 2)
                                                    {{"Đang gửi"}} 
                                                @endif 
                                                @if($item->status_order == 3)
                                                    {{"Đã hủy"}}    
                                                @endif
											</div>
										</div>
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Ngày đặt</div>
											<div class="cart_item_text">{{ $item->created_at }}</div>
										</div>
									</div>
								</li>
							
							</ul>
						</div>
						
						@if($item->status_order == 1)
						<div class="cart_buttons">
							<form action="{{ url('cart/order/'.$item->id ) }}" method="POST">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button type="submit" onclick="return confirm('Bạn chắc chắn muốn hủy đơn hàng này chứ?')" class="btn btn-primary" style="cursor: pointer;">Hủy đơn hàng</button>
							</form>
						</div>
						@endif
					</div>
					@endforeach

				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{ asset('js/cart_custom.js') }}"></script>
@endsection