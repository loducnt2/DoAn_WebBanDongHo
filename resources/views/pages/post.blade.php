@extends('layouts.index')

@section('tieude')
	Tin tức
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/blog_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/blog_responsive.css') }}">
@endsection

@section('content')
<!-- Home -->
<div class="home">
	<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
	<div class="home_overlay"></div>
	<div class="home_content d-flex flex-column align-items-center justify-content-center">
		<h2 class="home_title" style="font-family: arial; font-weight: bold;">Bài viết liên quan</h2>
	</div>
</div>

<!-- Blog -->

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
			</div>
		</div>

		<div class="row">
            <div class="col-sm-9"></div>
            <div class="col-sm-3">
                <div class="dataTables_paginate paging_simple_numbers"
                     id="dataTables-example_paginate">
                    {{ $post->links() }}
                </div>
            </div>
        </div>
	</div>
</div>
@endsection

@section('script')
	<script src="{{ asset('plugins/parallax-js-master/parallax.min.js') }}"></script>
	<script src="{{ asset('js/blog_custom.js') }}"></script>
@endsection