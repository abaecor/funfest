@extends('layouts.main')

@section('content')

	<div id='admin' class='filter_product'>
		<h3 class="section-title style2 text-center">
			<span>Edit a product</span>
		</h3>

		{{ Form::open(array('url'=>'admin/products/edit'))}}
			<p>
				{{ Form::label('title','Title') }}
				{{ Form::hidden('id', $products->id) }}
				{{ Form::text('title',$products->title ,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('description','Description') }}
				{{ Form::text('description',$products->description,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('regular_price','Regular price') }}
				{{ Form::text('regular_price',$products->regular_price,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('delux_price','Delux price') }}
				{{ Form::text('delux_price',$products->delux_price,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('premium_price','Premiun price') }}
				{{ Form::text('premium_price',$products->premium_price,array('class'=>'form-control input-md')) }}
			</p>
			<p>
				{{ Form::label('product_code','Product code') }}
				{{ Form::text('product_code',$products->product_code,array('class'=>'form-control input-md')) }}
			</p>
			{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}
		{{ Form::close() }}
	</div>
@stop		