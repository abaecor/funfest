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
		
		Dear User,<br/>

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
		            <td>
		            	Subtotal: Rs. {{ $total }}
		            </td>
		        </tr>
		      </tbody>
		    </table>
		    <hr>
	  	</div>
		The order has been successfully placed. Thanks for shopping with us.<br/>
		<h5>Billing details : </h5> <br/><br/>
		Order id 		: <?php echo $details_for_order['txnid'];?><br/><br/>
		Amount   		: <?php echo $details_for_order['subtotal'];?><br/><br/>
		Product info 	: <?php echo $info = ($details_for_order['udf2'] == 'cake') ?  Cakes::getproductdesc($details_for_order['product_id'][0]) :  Product::getproductdesc($details_for_order['product_id'][0]); ?><br/><br/>
		First name		: <?php echo $billing_det['first_name'];?><br/><br/>
		Last name 		: <?php echo $billing_det['last_name'];?><br/><br/>
		Address1 		: <?php echo $billing_det['address'];?><br/><br/>
		Address2		: <?php echo $billing_det['address2'];?><br/><br/>
		City			: <?php echo $billing_det['bcity'];?><br/><br/>
		Phone			: <?php echo $billing_det['mobile']?><br/><br/>

		<h5>Shipping details : </h5> <br/><br/>
		Delivery Date 	: <?php echo date('d-m-Y',strtotime($details_for_order['delivery_date']))?><br/><br/>
		First name		: <?php echo $shipping_det['first_name'];?><br/><br/>
		Last name 		: <?php echo $shipping_det['last_name'];?><br/><br/>
		Address1 		: <?php echo $shipping_det['address'];?><br/><br/>
		Address2		: <?php echo $shipping_det['address2'];?><br/><br/>
		City			: <?php echo $shipping_det['scity'];?><br/><br/>
		Phone			: <?php echo $shipping_det['mobile']?><br/><br/>

		<h5>Message</h5><br/>
		Message 		: {{ $details_for_order['personalmessage'] }}<br/>
		From 			: {{ $billing_det['first_name']." ".$billing_det['last_name'] }}<br/>
		<br/><br/>
		For order details go to Funfest and track your order to get the latest updates on your order.<br/>
		Thanks,<br/>
		Funfest Family<br/>
		care@Funfest.com<br/>	
		<img src="http://www.Funfest.com/images/logo.jpg"/>
</body>
</html>
