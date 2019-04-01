@extends('layouts.index')

@section('tieude')
	Liên hệ
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/contact_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/contact_responsive.css') }}">
@endsection

@section('content')
<div class="contact_info">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">
				
				@foreach($company as $itemCompany)
					<!-- Contact Item -->
					<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
						<div class="contact_info_image"><img src="images/contact_1.png" alt=""></div>
						<div class="contact_info_content">
							<div class="contact_info_title">Phone</div>
							<div class="contact_info_text">{{ $itemCompany->phone_company }}</div>
						</div>
					</div>

					<!-- Contact Item -->
					<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
						<div class="contact_info_image"><img src="images/contact_2.png" alt=""></div>
						<div class="contact_info_content">
							<div class="contact_info_title">Email</div>
							<div class="contact_info_text">{{ $itemCompany->email_company }}</div>
						</div>
					</div>

					<!-- Contact Item -->
					<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
						<div class="contact_info_image"><img src="images/contact_3.png" alt=""></div>
						<div class="contact_info_content">
							<div class="contact_info_title">Address</div>
							<div class="contact_info_text">{{ $itemCompany->address_company }}</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Contact Form -->

<div class="contact_form">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="contact_form_container">
					<div class="contact_form_title">Gửi liên hệ phản hồi đến cửa hàng</div>

				<!-- @if(count($errors) > 0)
				                    <div class="alert alert-danger">
				                        <ul>
				                            @foreach($errors->all() as $item)
				                                <li>{{ $item }}</li>
				                            @endforeach
				                        </ul>
				                    </div>
				                @endif -->

                <p>
                	{!! $errors->first('phone_con', '<span id="phone_con-error" style="color: red">:message</span>') !!}
                </p>

                @if(session('notify'))
                    <div class="alert alert-success">
                        {{ session('notify') }}
                    </div>
                @endif

					<form action="{{ url('contact') }}" method="POST" id="contact_form">
						<div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="text" name="name_con" id="contact_form_name" class="contact_form_name input_field" placeholder="Tên của ban..." required="required" data-error="Name is required.">
							<input type="email" name="email_con" id="contact_form_email" class="contact_form_email input_field" placeholder="Email..." required="required" data-error="Email is required.">
							<input name="phone_con" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Số điện thoại..." required="required">
						</div>
						<div class="contact_form_text">
							<textarea name="message_con" id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Nội dung..." required="required" data-error="Please, write us a message."></textarea>
						</div>
						<div class="contact_form_button">
							<button type="submit" class="button contact_submit_button">Gửi</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	<div class="panel"></div>
</div>

<!-- Map -->

<div class="contact_map">
	<div id="google_map" class="google_map">
		<div class="map_container">
			<div id="map"></div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
	<script src="{{ asset('js/contact_custom.js') }}"></script>
@endsection