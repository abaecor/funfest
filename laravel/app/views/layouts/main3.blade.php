<!DOCTYPE html>
<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Little Florist</title>
	<meta name='description' content="">
	<meta name='viewport' content="width=device-width">

	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::script('js/jquery-1.8.3.js') }}
</head>
<body>
	<div id='wrapper'>
		<header>
			<section id='top-panel'>
				<menu>	
					<li>{{ HTML::link('/','Home') }}</li>
					@if(Auth::check())
						<li>{{ HTML::link('users/signout','Sign Out') }}</li>
						<li>{{ HTML::link('/users/myaccount','My Account') }}</li>
						@if($super)
							<li>{{ HTML::link('admin/orders/index?super=1','Orders') }}</li>
						@elseif($vendor)
							<li>{{ HTML::link('admin/orders/index?vendor=1','Orders') }}</li>
						@else
							<li>{{ HTML::link('admin/orders/index','Orders') }}</li>	
						@endif	
						@if(!$super)
							<li>{{ HTML::link('home/cart','Cart') }}</li>
						@endif
						@if($vendor)
							<li>{{ HTML::link('admin/products/index','Add Products') }}</li>
							<li>{{ HTML::link('admin/outlets/index','Add Outlet') }}</li>
							<li>{{ HTML::link('admin/addons/index','Add Addon') }}</li>
						@endif
						@if($super)
							<li>{{ HTML::link('admin/categories/index','Vendor lists') }}</li>
							<li>{{ HTML::link('admin/products/index','Product lists') }}</li>
							<li>{{ HTML::link('adkmin/products/index','Add Products') }}</li>
							<li>{{ HTML::link('admin/categories/index','Add Categories') }}</li>
						@endif
					@else
						<li>{{ HTML::link('users/signin','Sign In') }}</li>
						<li>{{ HTML::link('users/newaccount','Sign Up') }}</li>
						<li>{{ HTML::link('home/cart','Cart') }}</li>
					@endif

					
				</menu>
				<div>
				{{ Form::open(array('url'=>'home/search','method'=>'get')) }}
				{{ Form::text('keyword',null,array('placeholder'=>'Search by keyword')) }}
				{{ Form::submit('Search',array('class'=>'btn')) }}
				{{ Form::close() }}
				</div>
				<div class="all_categories">
					@foreach ($catnav as $cat)
						<li>{{ HTML::link('/home/category/'.$cat->id , $cat->name) }}</li>
					@endforeach 
				</div>

			</section> <!-- end top panel -->
		</header>
		<section id='main-content' class='clearfix'>
			
			@if(Session::has('message'))
				<p class='alert'>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ Session::get('message') }}
				</p>
			@endif

			@yield('content')
		</section><!-- end main content -->
		<hr/>
			@yield('pagination')
		<footer>
			
		</footer>	
	</div> <!-- end wrapper -->
	{{ HTML::script('js/jquery.jgrowl.js') }}
	{{ HTML::script('js/jquery.validate.min.js') }}
</body>
