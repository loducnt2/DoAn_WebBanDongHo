@extends('layouts.index')

@section('tieude')
	Chi tiết bài viết
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/blog_single_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/blog_single_responsive.css') }}">
@endsection

@section('content')
<div class="home">
	<div class="home_background parallax-window" data-parallax="scroll" data-image-src='{{ url("upload/post/$postSingle->thumbnail") }}' style="height: 100px;" data-speed="0.8"></div>
</div>

<!-- Single Blog Post -->

<div class="single_post">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="single_post_title" style="font-family: arial; font-weight: bold;">{{ $postSingle->title }}</div>
				<div class="single_post_text">
					<p style="font-family: arial; font-weight: bold;">{!! $postSingle->contents !!}</p>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Blog Posts -->

<div class="blog">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="blog_posts d-flex flex-row align-items-start justify-content-between">

					<!-- Blog post -->
					@foreach($post as $item)
					<div class="blog_post">
						<div style="display: flex; justify-content: center; align-items: center;">
							<img src='{{ url("upload/post/$item->thumbnail") }}'  width="50%" height="200px" > 
						</div>
						<div class="blog_text" style="font-family: arial; font-weight: bold;">{{ $item->title }}</div>
						<div class="blog_button"><a href='{{ url("post/$item->id/$item->unsign_title.html") }}'>Chi tiết</a></div>
					</div>
					@endforeach

				</div>
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4">
						{{ $post->links() }}
					</div>
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
