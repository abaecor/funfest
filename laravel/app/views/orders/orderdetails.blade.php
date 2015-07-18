@extends('layouts.main')

@section('content')
<h3 class="section-title style2 text-center">
	<span>Order details</span>
</h3>
@if($orders->count())
	@foreach ($orders as $key => $value) 
	<div class='orderinfo'>
		<h4>Basic order</h4>
		<ul>
		<li>Order id - {{ $value->order_id }}	</li>
		<li>Vendor name - {{ $ven_name = User::fetch_name($value->vendor_id); }}</li>
		<li>Order Date/Time  - {{ $value->created_at }}</li>
		<li>Bill value  - {{ $value->price }}</li>
		<li><i class="glyphicon glyphicon-phone-alt"> </i> {{ $vendor_det[0]['phone'] }}</li>
		</ul>
	</div>
	<div class='orderinfo'>
		<h4>Shipping Details</h4>
		<ul>
		<li>Name  - {{ $value->name }}</li>
		<li>Address - {{ $value->shipping_address }}	</li>
		<li>City - {{ $value->shipping_city }}</li>
		<li>Zip - {{ $value->shipping_zip }}</li>
		<li>Contact  - {{ $value->contact }}</li>
		</ul>
	</div>
	<?php $orderstats = $value->status;?>
	@endforeach
	@foreach ($orders_billing as $key => $value)
		<div class='orderinfo'>
			<h4>Billing Details</h4>
			<ul>
			<li>Name  - {{ $value->name }}</li>
			<li>Address - {{ $value->billing_address }}	</li>
			<li>City - {{ $value->billing_city }}</li>
			<li>Zip - {{ $value->billing_zip }}</li>
			<li>Contact  - {{ $value->contact }}</li>
			<li>Disc code - {{ ($disc_code == "") ? "N/A" : $disc_code }}</li>
			</ul>
		</div>
	@endforeach
	<div class="orderinfo">
		<h2>Status </h2>
		<h3><?php $st = ($orderstats == 'neworder') ? 'Under process' : $orderstats; echo $st;?></h3>
	</div>
	<div class='clearfix'></div>
	<h4 class="orderinfocaps"><a href="/"><i class="fa fa-chevron-left"></i> Back to shopping </a></h4>
@else
	<div style="text-align:center;">
	<h3>Order id incorrect/could not be found. Please mail us at <i>care@Funfest.com</i> for further details.</h3>
	</div>
@endif
@stop