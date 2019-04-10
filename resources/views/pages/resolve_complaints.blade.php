@extends('layouts.index')

@section('tieude')
	Chính sách giải quyết khiếu nại
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/blog_single_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/blog_single_responsive.css') }}">
@endsection

@section('content')

<!-- Single Blog Post -->
<div class="single_post">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="single_post_title" style="font-family: arial; font-weight: bold;">Chính Sách Giải Quyết Khiếu Nại</div>
				<div class="single_post_text">
					@foreach($company as $item)
						<p>{!! $item->resolve_complaints !!}</p>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script src="{{ asset('plugins/parallax-js-master/parallax.min.js') }}"></script>
	<script src="{{ asset('js/blog_single_custom.js') }}"></script>
@endsection
