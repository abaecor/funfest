@extends('layouts.main')

@section('content')
<div>
	<h3 class="section-title style2 text-center">
		<span>Order history</span>
	</h3>

	<table class='table table-striped'>
		<tr>
			<th>#</th>
			<th>Order id</th>
			<th>Product id</th>
			<th>Addons</th>
			<th>Status</th>
			<th>Name</th>
			<th>Contact</th>
			<th>Shipping address</th>
			<th>Shipping zip</th>
			<th>Shipping city</th>
			<th>Bill Value</th>
			<th>Qty</th>
			<th>Rate your vendor</th>
		</tr>
		@foreach($orders as $key=>$order)
		<tr>
			<?php  $k = $key+1 ?>
			<td>{{ $k }}</td>
			<td>{{ $order->order_id }}</td>
			<td>{{ $order->product_id }}</td>
			<td>{{ $order->add_on_id }}</td>
			<td>{{ $order->status }}</td>
			<td>{{ $order->name }}</td>
			<td>{{ $order->contact }}</td>
			<td>{{ $order->shipping_address }}</td>
			<td>{{ $order->shipping_zip }}</td>
			<td>{{ $order->shipping_city }}</td>
			<td>{{ $order->price }}</td>
			<td>{{ $order->quantity }}</td>
			<td>
			<input id="input-id" type="number" class="rating" step=0.5 data-size="xs" value="{{ $order->rvalue }}">
				{{ Form::hidden('vendor_id', $order->vendor_id,array('class'=>'vid')) }}
				{{ Form::hidden('user_id', $order->user_id,array('class'=>'uid')) }}
				{{ Form::hidden('order_id', $order->order_id,array('class'=>'oid')) }}
			</td>
		</tr>
		@endforeach
	</table>
</div>	
@stop