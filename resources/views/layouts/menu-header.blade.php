
<nav class="main_nav">
	<div class="container">
		<div class="row">
			<div class="col">
				
				<div class="main_nav_content d-flex flex-row">

					<!-- Categories Menu -->

					<div class="cat_menu_container">
						<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
							<div class="cat_burger"><span></span><span></span><span></span></div>
							<div class="cat_menu_text">thương hiệu</div>
						</div>

						<ul class="cat_menu">
						@foreach($trade as $item)
							@if(count($item->product) > 0)
								<li><a href='{{ url("shop/$item->id") }}'>{{ $item->name_trade }} <i class="fas fa-chevron-right ml-auto"></i></a></li>
							@endif
						@endforeach
							<!-- <li class="hassubs">
								<a href="#">Hardware<i class="fas fa-chevron-right"></i></a>
								<ul>
									<li class="hassubs">
										<a href="#">Menu Item<i class="fas fa-chevron-right"></i></a>
										<ul>
											<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
										</ul>
									</li>
									<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
									<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
									<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								</ul>
							</li> -->
							
						</ul>
					</div>

					<!-- Main Nav Menu -->

					<div class="main_nav_menu ml-auto">
						<ul class="standard_dropdown main_nav_dropdown">
							<li style="margin-right: 15px;"><a style="font-size: 16px;" href="{{ url('home') }}">Home<i class="fas fa-chevron-down"></i></a></li>

							@foreach($cate as $item)
								
							<li class="hassubs" style="margin-right: 15px;">
								<a href='{{ url("category/$item->id") }}' style="font-size: 16px;">{{ $item->name_cate }}<!-- <i class="fas fa-chevron-down"></i> --></a>
								<ul>
									<!-- <li>
										<a href="#">Menu Item<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li> -->
									
									<!--   day nhé  -->
									

								</ul>
							</li>

							@endforeach

							<li class="hassubs" style="margin-right: 15px;">
								<a href="{{ url('shop/1') }}" style="font-size: 16px;">Mua sắm</a>
								<!-- <ul>
									<li><a href="{{ url('shop/1') }}">Mua sắm<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="{{ url('blog') }}">Bài viết<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="{{ url('blog_single') }}">Blog Post<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="{{ url('regular') }}">Regular Post<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="cart.html">Cart<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="{{ url('contact') }}">Liên hệ<i class="fas fa-chevron-down"></i></a></li>
								</ul> -->
							</li>
							<li style="margin-right: 15px;"><a href="{{ url('post') }}" style="font-size: 16px;">Bài viết<i class="fas fa-chevron-down"></i></a></li>
							<li style="margin-right: 15px;"><a href="{{ url('contact') }}" style="font-size: 16px;">Liên hệ<i class="fas fa-chevron-down"></i></a></li>
						</ul>
					</div>

					<!-- Menu Trigger -->

					<div class="menu_trigger_container ml-auto">
						<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
							<div class="menu_burger">
								<div class="menu_trigger_text">menu</div>
								<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</nav>