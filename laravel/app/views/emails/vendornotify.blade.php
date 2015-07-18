<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
<?php 
	$shipping_det = (array) $details_for_order['shipping'];
	$billing_det = (array) $details_for_order['billing'];
?>
	<h4>Order ID <?php echo $details_for_order['txnid'];?></h4>
		Dear Vendor,<br/>

		<div class="cartContent w100 checkoutReview ">
		    <table class="cartTable table-responsive"   style="width:100%">
		      <tbody>
		        <tr class="CartProduct cartTableHeader">
		          <th> Product </th>
		          <th class="checkoutReviewTdDetails">Description</th>
		          <th class="center">Qty</th>
		          <th class="center">Total</th>
		        </tr>
		        @foreach($products as $product)
		        <tr style="text-align: center;">
		          <td  class="CartProductThumb">
		          	<div> 
		          		{{ HTML::image($product->image,$product->name,array('width'=>65)) }} 
		          	</div>
		          </td>
		          <td>
		          	<div class="CartDescription">
		              	<h4> {{ $product->name }}</h4>
		            </div>
		          </td>
		          <td>{{ $product->quantity }}</td>
		          <td>Rs {{ $product->price }}</td>
		        </tr>
		        @endforeach
		        <tr style="text-align: center;">
		            <td></td>
		            <td></td>
		            <td></td>
		            <td class="center">
		            	Subtotal: Rs. {{ $total }}
		            </td>
		        </tr>
		      </tbody>
		    </table>
		    <hr>
	  	</div>
		You have received a new order.<br/><br/>
		
		<h5>Shipping details : </h5> <br/>
		Delivery Date 	: {{ date('d-m-Y',strtotime($details_for_order['delivery_date'])) }} <br/><br/>
		First name		: {{ $shipping_det['first_name'] }} <br/><br/>
		Last name 		: {{ $shipping_det['last_name'] }} <br/><br/>
		Address1 		: {{ $shipping_det['address'] }} <br/><br/>
		Address2		: {{ $shipping_det['address2'] }} <br/><br/>
		City			: {{ $shipping_det['scity'] }} <br/><br/>
		Phone			: {{ $shipping_det['mobile'] }} <br/><br/>

		<h5>Biller's name :</h5><br/>
		Message  		: {{ $details_for_order['personalmessage'] }}<br/>
		From 			: {{ $billing_det['first_name']." ".$billing_det['last_name'] }}<br/>
		
		<br/><br/>
		For order details go to little florist and track your order to update the order.
		<br/>
		Thanks,<br/>
		Little florist Family<br/>
		care@littleflorist.com<br/>	
		<img src="http://www.littleflorist.com/images/logo.jpg"/>
</body>
</html>
