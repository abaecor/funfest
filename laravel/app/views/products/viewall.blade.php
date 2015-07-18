@extends('layouts.main')

@section('content')
	
	<div id='admin' class="productlist">
		<h3 class="section-title style2 text-center">
			<span>Product List</span>
		</h3>
			<div class="inner-addon left-addon">
			    <i class="glyphicon glyphicon-search"></i>
			    <input type="text" class="form-control" placeholder="Search title"/>
			</div>
			<div class="tab-content">
				<div class="tab-pane active" id="order">
					<table class='table table-striped'>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Description</th>
						<th>Regular price</th>
						<th>Delux price</th>
						<th>Premium price</th>
						<th>Product code</th>
						<th></th>
					</tr>
					@foreach ($products as $key => $value)
					<tr>
						<td>
							{{ HTML::image($value->image , $value->title,array('class'=>'img-responsive')) }}
						</td>
						<td class='title'>{{ $value->title }}</td>
						<td>{{ $value->description }}</td>
						<td>
							{{ $value->regular_price }}
						</td>
						<td>
							{{ $value->delux_price }}
						</td>
						<td>
							{{$value->premium_price}}
						</td>
						<td>
							{{$value->product_code}}
						</td>
						<th>
							<span class='links'><a href="/admin/products/edit/{{ $value->id }}">Edit</a></span>  
							@if($super)
							<span class='links'><a href="/admin/products/destroy/{{ $value->id }}"> | Delete</a></span>  
							@endif
						</th>
					</tr>	
					@endforeach
					</table>
				</div>
			</div>	
	</div>
@stop