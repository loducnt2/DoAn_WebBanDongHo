<!-- Newsletter -->
@foreach($company as $itemCompany)
<div class="newsletter">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
					<div class="newsletter_title_container">
						<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
						<div class="newsletter_title">Đăng ký nhận bản tin từ CudLo</div>
						<div class="newsletter_text"><p>Đừng bỏ lỡ hàng ngàn sản phẩm và chương trình siêu hấp dẫn</p></div>
					</div>
					<div class="newsletter_content clearfix">
						<form action="{{ url('home') }}" class="newsletter_form" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="email" class="newsletter_input" name="email" required="required" placeholder="Địa chỉ email của bạn">
								{!! $errors->first('email', '<span id="email-error" style="color: red">:message</span>') !!}
							<button type="submit" class="newsletter_button">Đămg ký</button>
						</form>
						<!-- <div class="newsletter_unsubscribe_link"><a href="#">Hủy đăng ký</a></div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Footer -->
<footer class="footer">
	<div class="container" style="border-top: 1px solid #aaa; padding-top: 20px;">
		<div class="row">

			<div class="col-lg-3 footer_col">
				<div class="footer_column footer_contact">
					<div class="logo_container">
						<div class="logo"><a href="#">{{ $itemCompany->name_company }}</a></div>
					</div>
					<div class="footer_title">Got Question? Call Us 24/7</div>
					<div class="footer_phone">{{ $itemCompany->phone_company }}</div>
					<div class="footer_contact_text">
						<p>{{ $itemCompany->address_company }}</p>
					</div>
					<div class="footer_social">
						<ul>
							<li><a href="{{ $itemCompany->link_fb }}"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="{{ $itemCompany->link_twiter }}"><i class="fab fa-twitter"></i></a></li>
							<li><a href="{{ $itemCompany->link_youtube }}"><i class="fab fa-youtube"></i></a></li>
							<li><a href="{{ $itemCompany->link_g }}"><i class="fab fa-google"></i></a></li>
							<li><a href="{{ $itemCompany->link_vimeo }}"><i class="fab fa-vimeo-v"></i></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-lg-2 offset-lg-2">
				<div class="footer_column">
					<div class="footer_title">Tìm nhanh</div>
					<ul class="footer_list">
					@foreach($trade as $item)
						<li><a href='{{ url("shop/$item->id") }}'>{{ $item->name_trade }}</a></li>
					@endforeach
					</ul>
				</div>
			</div>

			<div class="col-lg-2">
				<div class="footer_column">
					<div class="footer_title">Về Cudlo</div>
					<ul class="footer_list">
						<li><a href="{{ url('introduce') }}">Giới thiệu Cudlo</a></li>
						<li><a href="{{ url('resolve_complaints') }}">Giải quyết khiếu nại</a></li>
						<li><a href="{{ url('rules') }}">Điều khoản sử dụng</a></li>
					</ul>
				</div>
			</div>

			<div class="col-lg-2">
				<div class="footer_column">
					<div class="footer_title">Hỗ trợ khách hàng</div>
					<ul class="footer_list">
						<li><a href="{{ url('client') }}">Tài khoản</a></li>
						<li><a href="{{ url('return_policy') }}">Chính sách đổi trả</a></li>
						<li><a href="{{ url('policy_foreigner') }}">Chính sách hàng nhập khẩu</a></li>
						<li><a href="{{ url('delivery_time') }}">Cudlo giao hàng trong bao lâu?</a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>
</footer>

<!-- Copyright -->
<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col">
				
				<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
					<div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
					<div class="logos ml-sm-auto">
						<ul class="logos_list">
							<li><a href="#"><img src="images/logos_1.png" alt=""></a></li>
							<li><a href="#"><img src="images/logos_2.png" alt=""></a></li>
							<li><a href="#"><img src="images/logos_3.png" alt=""></a></li>
							<li><a href="#"><img src="images/logos_4.png" alt=""></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach