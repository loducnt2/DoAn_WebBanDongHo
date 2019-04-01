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
				<div class="col-lg-10 offset-lg-1">
					<div class="cart_container">
						<div class="cart_title">Đơn hàng gồm: </div>
						<div class="cart_items">
							<ul class="cart_list">

							@foreach($detail as $item)
								<li class="cart_item clearfix">
									<div class="cart_item_image">
										<?php $anh = $item->product->thumbnail_pro ?>
										<img src='{{ url("upload/product/$anh") }}' width="100px" height="100px" width="50px" height="50px">
									</div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Tên sản phẩm</div>
											<div class="cart_item_text">{{ $item->product->name_pro }}</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Số lượng</div>
											<div class="cart_item_text">
												{{ $item->product->quantity_pro }}
											</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Đơn giá</div>
											<div class="cart_item_text">
												{{ $item->product->price_pro }}
											</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Khuyến mại</div>
											<div class="cart_item_text">
												{{ $item->product->discount_pro }}
											</div>
										</div>
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Thành tiền</div>
											<div class="cart_item_text">
						<?php 
                            $totalAmount = 0; 
                        ?>
                            <?php 
                                $Newdiscount = (100-$item->product->discount_pro)/100;
                                $totalAmount += ($item->quantity*$item->product->price_pro*$Newdiscount);
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

					@foreach($orders as $item)
					<div class="cart_container">
						<div class="cart_title">Cập nhật hóa đơn: </div>
						<div class="cart_items">
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
												<?php 
                                                    $totalAmount = 0; 
                                                ?>
                                                    @foreach($item->orderdetail as $dItem)
                                                        <?php 
                                                            $Newdiscount = (100-$dItem->product->discount_pro)/100;
                                                            $totalAmount += ($dItem->quantity*$dItem->product->price_pro*$Newdiscount);
                                                         ?>
                                                    @endforeach
                                                    {{ number_format($totalAmount) }}
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
									</div>
								</li>
							
							</ul>
						</div>
						
						<div class="cart_buttons">
						<form action="{{ url('cart/order/'.$item->id ) }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" onclick="return confirm('Bạn chắc chắn muốn hủy đơn hàng này chứ?')" class="btn btn-primary">Hủy đơn hàng</button>
						</form>
							
						</div>
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