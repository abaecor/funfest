<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>Order ID <?php echo $details_for_order['txnid'];?></h2>
		
		Dear User,<br/>

		<div class="cartContent w100 checkoutReview ">
		    <table class="cartTable table-responsive"   style="width:100%">
		      <tbody>
		        <tr class="CartProduct cartTableHeader">
		          <th> Product </th>
		          <th class="checkoutReviewTdDetails">Details</th>
		          <th class="center">Qty</th>
		          <th class="center">Total</th>
		        </tr>
		        @foreach($products as $product)
		        <tr class="CartProduct">
		          <td  class="CartProductThumb">
		          	<div> 
		          		{{ HTML::image($product->image,$product->name,array('width'=>65)) }} 
		          		{{ Form::hidden('product_id[]', $product->id) }}
		          		{{ Form::hidden('product_quantity[]', $product->quantity) }}
		          		{{ Form::hidden('product_vendor_id[]', $product->vendor_id) }}
		          	</div>
		          </td>
		          <td>
		          	<div class="CartDescription">
		              	<h4> {{ $product->name }}</h4>
		            </div>
		          </td>
		          <td>1</td>
		          <td>Rs {{ $product->price }}</td>
		        </tr>
		        @endforeach
		        <tr>
		            <td></td>
		            <td></td>
		            <td></td>
		            <td class="center">
		            	Subtotal: Rs. {{ Cart::total() }} 
		            </td>
		        </tr>
		      </tbody>
		    </table>
		    <hr>
		  </div>
		Hope this mail finds you in good spirits.<br/>

		The order has been cancelled from our end. Please let us know if there is anything else you need assistance with.<br/><br/>

		Thanks,<br/>
		Funfest Family<br/>
		care@Funfest.com<br/>	
		<img src="http://www.Funfest.com/images/logo.jpg"/>
</body>
</html>
