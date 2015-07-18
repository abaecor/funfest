@extends('layouts.main')

@section('content')
<div>
	<h3 class="section-title style2 text-center">
		<span>Order history</span>
	</h3>

	@if($super)
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#order" data-toggle="tab"> <span>Vendor Orders</span></a></li>
		  <li> <a href="#ordermaster" data-toggle="tab"> <span>Order master</span></a></li>
		</ul>
	@endif

	<div class="tab-content">
		<div class="tab-pane active" id="order">
			<table class='table table-striped'>
				<tr>
					<th>#</th>
					<th>Order id</th>
					@if($super)
					<th>Vendor code</th>
					<th>Disc code</th>
					@endif
					<th>Delivery Date</th>
					<th>Status</th>
					<th>Name</th>
					<th>Contact</th>
					<th>Shipping address</th>
					<th>Shipping zip</th>
					<th>Shipping city</th>
					<th>Shipping state</th>
					<th>Bill Value</th>
					<th>Qty</th>
					<th>Payment clearance</th>
					<!--<th>Process</th>-->
				</tr>
				@foreach($orders as $key=>$order)
					<tr>
						<?php  $k = $key+1 ?>
						<td>{{ $k }}</td>
						<td class="order_id">{{ HTML::link('orders/view/'.$order->order_id,$order->order_id) }}</td>
						@if($super)
							<td>{{ User::getvendorcode($order->vendor_id) }}</td>
							<td>{{ ($order->disc_code == "") ? "N/A" : $order->disc_code }}</td>
						@endif
						<td>{{ $order->delivery_date }}</td>
						<?php
							$st = $order->status == 'neworder' ? '3' : ($order->status == 'dispatched' ? '2' : ( $order->status == 'delivered' ? '1' : '0'));
						?>
						<td>{{ Form::select('status', array('cancelled','delivered','dispatched','neworder'), $st ,array('id'=>'orderstatus'))}}</td>
						<td>{{ $order->name }}</td>
						<td class="phone">{{ $order->contact }}</td>
						<td>{{ $order->shipping_address }}</td>
						<td>{{ $order->shipping_zip }}</td>
						<td>{{ $order->shipping_city }}</td>
						<td>{{ $order->shipping_state }}</td>
						<td>{{ $order->price }}</td>
						<td>{{ $order->quantity }}</td>
						@if($super)
							<?php $st = $order->payment_clearance == 'cleared' ? '1' : '2';?>
							<td>{{ Form::select('payment_clearance', array('select','cleared','uncleared'), $st ,array('id'=>'payment_clearance')) }}</td>
							<?php //$st = $order->status == 'new' ? '1' : '2';?>
							<!--<td>{{ Form::select('process', array('select','new','initiate'),$st)}}</td>-->
						@else
							<td>{{ $order->payment_clearance}}</td>
							<!-- <td>{{ $order->process }}</td>-->
						@endif
					</tr>
				@endforeach
			</table>
		</div>	
		@if($super)
		<div class="tab-pane" id="ordermaster">
			<table class='table table-striped'>
				<tr>
					<th>#</th>
					<th>Order id</th>
					<th>Transaction id</th>
					<th>Bank transaction id</th>
					<th>Payment method</th>
					<th>Name</th>
					<th>Contact</th>
					<th>Billing address</th>
					<th>Billing zip</th>
					<th>Bill Value</th>
					<th>Transaction message</th>
					<th>Status</th>
					<th>Process</th>
				</tr>
				@foreach($ordermasters as $key=>$ordermaster)
					<tr>
						<?php $k = $key+1 ?>
						<td>{{ $k }}</td>
						<td>{{ $ordermaster->order_id }}</td>
						<td>{{ $ordermaster->transaction_id }}</td>
						<td>{{ $ordermaster->bank_transaction_id }}</td>
						<td>{{ $ordermaster->payment_method }}</td>
						<td>{{ $ordermaster->name }}</td>
						<td>{{ $ordermaster->contact }}</td>
						<td>{{ $ordermaster->billing_address }}</td>
						<td>{{ $ordermaster->billing_zip }}</td>
						<td>{{ $ordermaster->bill_value }}</td>
						<td>{{ $ordermaster->transaction_message }}</td>
						<td>{{ $ordermaster->status }}</td>
						<td>{{ $ordermaster->process }}</td>
					</tr>
				@endforeach
			</table>
		</div>	
		@endif
	</div>	
</div>	
@stop
