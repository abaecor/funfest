@extends('layouts.main')

@section('content')
<?php $delivery_date = "";?>
<h3 class="section-title style2 text-center">
	<span>Cart details</span>
</h3>

<div class="row">
	<div class="col-lg-9 col-md-9 col-sm-7">
		<h1 class="section-title-inner"><span><i class="glyphicon glyphicon-shopping-cart"></i> Checkout</span></h1>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-5 rightSidebar">
		<h4 class="caps"><a href="/"><i class="fa fa-chevron-left"></i> Back to shopping </a></h4>
	</div>
</div> <!--/.row-->

<div class="col-xs-12 col-sm-12">
  <div class="cartContent w100 checkoutReview ">
    <table class="cartTable table-responsive"   style="width:100%">
      <tbody>
        <tr class="CartProduct cartTableHeader">
          <th> Product </th>
          <th class="checkoutReviewTdDetails">Details</th>
          <th class="center">Qty</th>
          <th class="center">Total</th>
        </tr>
        <?php $vendorlist = "";?>
        @foreach($products as $product)
        <?php
			$delivery_date = $product->delivery_date;
		?>
        <tr class="CartProduct">
          <td  class="CartProductThumb">
          	<div> 
          		<?php if($product->type == 'p'){ ?>
	          		{{ HTML::image($product->image,$product->name,array('width'=>65)) }} 
	          		{{ Form::hidden('product_id[]', $product->id) }}
	          		{{ Form::hidden('product_quantity[]', $product->quantity) }}
	          		{{ Form::hidden('product_vendor_id[]', $product->vendor_id) }}
	          	<?php } else { ?>
	          		{{ HTML::image($product->image,$product->name,array('width'=>65)) }} 
	          		{{ Form::hidden('addon_id[]', $product->id) }}
	          		{{ Form::hidden('addon_quantity[]', $product->quantity) }}
	          		{{ Form::hidden('addon_vendor_id[]', $product->vendor_id) }}
	          	<?php } ?>
	          	<?php $vendorlist .= $product->vendor_id.","; ?>
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
        <?php $vendorlist = rtrim($vendorlist,','); ?>
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
</div>
{{ Form::hidden('subtotal',Cart::total()) }}
{{ Form::hidden('user_id', $user_id) }}
<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a class='step1' data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					<b>Step 1 (Addons & Message)</b>
				</a>
			</h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
			<div class="panel-body">
				<label>Date of delivery</label>
				<input readonly="true" name="delivery_date" value="<?php echo $delivery_date;?>" class="form-control">
				<label>Add a message : </label>
				<textarea id="personalmessage" name='personalmessage' class='form-control required'></textarea>
				@if(count($addon_items) != 0 && $addon_items != "")
				<div class="productFilter addons_slider">
					<strong>Make your order special</strong>
					<div id="SimilarProductSlider">
					    
						@foreach ($addon_items as $aitem) 
						<div class="item">
							<div class="addons"> 
								<a class="/home/view/{{$aitem->id}}">{{ HTML::image($aitem->image, $aitem->title)}} </a>
								<div class="description">
									<h4>{{$aitem->description}}</h4>
									{{Form::checkbox('aid',$aitem->id)}}
									<div class="price"> <span>{{$aitem->price}}</span> </div>
								</div>
							</div>
						</div>
						@endforeach
						
					</div>
				</div>
				@endif
				<label>Add a coupon code : </label>
				<input id='addcoupon' name='coupon' type='textarea' class='form-control'>
				<div class="center top30">
					<button class='btn btn-primary cnt_btn'>continue</button>
				</div>
			</div>
			
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a class='step2' data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
					<b>Step 2 (Shipping address)</b>
				</a>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="w100 clearfix">
					<div class="row user_shipping_Info">
						<div class="col-lg-12">
							<h2 class="block-title-2"> To add a new address, please fill out the form below. </h2>
						</div>

						
							<div class="col-xs-12 col-sm-6">
								<div class="form-group required">
									<label for="InputName">First Name <sup>*</sup> </label>
									<input name='shipping[first_name]' required type="text" class="form-control  required" id="InputName" placeholder="First Name">
								</div>
								<div class="form-group required">
									<label for="InputLastName">Last Name <sup>*</sup> </label>
									<input name='shipping[last_name]' required type="text" class="form-control  required" id="InputLastName" placeholder="Last Name">
								</div>
								<div class="form-group required">
									<label for="InputAddress">Address <sup>*</sup> </label>
									<input name='shipping[address]' required type="text" class="form-control  required" id="InputAddress" placeholder="Address">
								</div>
								<div class="form-group">
									<label for="InputAddress2">Address (Line 2) </label>
									<input name='shipping[address2]' type="text" class="form-control" id="InputAddress2" placeholder="Address">
								</div>
								<div class="form-group required">
									<label for="InputState">State <sup>*</sup> </label>
									<input name='shipping[state]' required type="text" class="form-control  required" id="InputState" placeholder="State">
								</div>
								<div class="form-group required">
									<label for="InputCity">City <sup>*</sup> </label>

									<select name='shipping[city]' class="form-control  required" required aria-required="true" id="InputCity" name="InputCity">
										<option value="">Choose</option>
										<?php
								    		foreach ($city_list as $key => $value) {
								    		 	echo '<option value='.$value['name'].'>'.$value['name'].'</option>';
								    		 }  
								    	?>
									</select>
									<input type="hidden" name='shipping[scity]' class='scity'>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group required">
									<label for="InputZip">Zip / Postal Code <sup>*</sup> </label>
									<input name='shipping[zip_code]' required type="text" class="form-control required" id="InputZip" placeholder="Zip / Postal Code">
								</div>
								<div class="form-group required">
									<label for="InputCountry">Landmarks <sup>*</sup> </label>
									<input name='shipping[landmarks]' class="form-control required" required aria-required="true" id="landmarks" name="landmarks">
								</div>
								<div class="form-group">
									<label for="InputAdditionalInformation">Additional information</label>
									<textarea name='shipping[additional_info]' rows="3" cols="26" name="InputAdditionalInformation" class="form-control" id="InputAdditionalInformation"></textarea>
								</div>
								<div class="form-group required">
									<label for="InputMobile">Mobile phone <sup>*</sup></label>
									<input name='shipping[mobile]' required type="tel"  name="InputMobile" class="form-control required" id="InputMobile">
								</div>
							</div>
					</div>
					<div class="center top30">
						<button class='btn btn-primary cnt_btn2'>continue</button>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a class='step3' data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
					<b>Step 3 (Billing address & Checkout)</b>
				</a>
			</h4>
		</div>
		<div id="collapseThree" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="w100 clearfix">
					<div class="row user_billing_Info">
						<div class="col-lg-12">
							<input type="checkbox" class='cbx_copy'> Copy shipping address.<br/>
							<h2 class="block-title-2"> To add a new address, please fill out the form below. </h2>
						</div>

							<div class="col-xs-12 col-sm-6">
								<div class="form-group required">
									<label for="BInputName">First Name <sup>*</sup> </label>
									<input name='billing[first_name]' required type="text" class="form-control required" id="BInputName" placeholder="First Name" value="<?php if(isset($_POST['email'])){echo $_POST['firstname'];} ?>">
								</div>
								<div class="form-group required">
									<label for="BInputLastName">Last Name <sup>*</sup> </label>
									<input name='billing[last_name]' required type="text" class="form-control required" id="BInputLastName" placeholder="Last Name" value="<?php if(isset($_POST['email'])){echo $_POST['lastname'];} ?>">
								</div>
								<div class="form-group">
									<label for="BInputEmail">Email </label>
									<input name='billing[email]' type="text" class="form-control required" id="BInputEmail" placeholder="Email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
								</div>
								<div class="form-group required">
									<label for="BInputAddress">Address <sup>*</sup> </label>
									<input name='billing[address]' required type="text" class="form-control required" id="BInputAddress" placeholder="Address" value="<?php if(isset($_POST['email'])){echo $_POST['address1'];} ?>">
								</div>
								<div class="form-group">
									<label for="BInputAddress2">Address (Line 2) </label>
									<input name='billing[address2]' type="text" class="form-control" id="BInputAddress2" placeholder="Address" value="<?php if(isset($_POST['email'])){echo $_POST['address2'];} ?>">
								</div>
								<div class="form-group required">
									<label for="BInputState">State <sup>*</sup> </label>
									<input name='billing[state]' required type="text" class="form-control required" id="BInputState" placeholder="City" value="<?php if(isset($_POST['email'])){echo $_POST['state'];} ?>">
								</div>
								<div class="form-group required">
									<label for="BInputCity">City <sup>*</sup> </label>

									<select name='billing[city]' class="form-control required" required aria-required="true" id="BInputCity" name="InputState">
										<option value="">Choose</option>
										<?php
								    		foreach ($city_list as $key => $value) {
								    		 	echo '<option value='.$value['name'].'>'.$value['name'].'</option>';
								    		 }  
								    	?>
									</select>
									<input type="hidden" name='billing[bcity]' class='bcity'>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group required">
									<label for="BInputZip">Zip / Postal Code <sup>*</sup> </label>
									<input name='billing[zip_code]' required type="text" class="form-control required" id="BInputZip" placeholder="Zip / Postal Code">
								</div>
								<div class="form-group required">
									<label for="BLandmarks">Landmarks <sup>*</sup> </label>
									<input name='billing[landmarks]' class="form-control required" required aria-required="true" id="BLandmarks" name="landmarks">
								</div>
								<div class="form-group">
									<label for="BInputAdditionalInformation">Additional information</label>
									<textarea name='billing[additional_info]' rows="3" cols="26" name="InputAdditionalInformation" class="form-control" id="BInputAdditionalInformation"></textarea>
								</div>
								<div class="form-group required">
									<label for="BInputMobile">Mobile phone <sup>*</sup></label>
									<input name='billing[mobile]' required type="tel"  name="InputMobile" class="form-control required" id="BInputMobile" value="<?php if(isset($_POST['email'])){echo $_POST['phone'];} ?>">
								</div>
							</div>
					</div>

				</div>
				<!-- 
				<label>Choose payment method</label>
				<div>
					<ul class="nav nav-tabs">
					<li class="active"><a href="#Tab1" data-toggle="tab">Credit Card</a></li>
						<li><a href="#Tab2" data-toggle="tab">Debit Card</a></li>
						<li><a href="#Tab3" data-toggle="tab">Netbanking</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="Tab1">
							<p> <strong>Space for credit card module</strong> </p>
						</div>

						<div class="tab-pane" id="Tab2">
							<p> <strong>Space for debit card module</strong> </p>
						</div>

						<div class="tab-pane" id="Tab3">
							<p> <strong>Space for netbanking</strong> </p>
						</div>
					</div> 
				</div> 
				-->

				<!-- <button class='btn btn-primary saveorder right'>Save order</button> -->
				<form method="post" action="https://test.payu.in/_payment">
					<!-- 2Dk5xp -->
				    <input type="hidden" id="key" name="key" value="C0Dr8m" />
				    <?php 
				    	if(isset($txnid)){
				    		$uuid = $txnid;
				    	} else {
					    	$uuid = uniqid();
				    	}
				    ?>
				    <input type="hidden" id="txnid" name="txnid" value="<?php echo $uuid;?>" />
				    <input type="hidden" id="amt" name="amount" value="" />
				    <input type="hidden" id="productinfo" name="productinfo" value="" />
				    <input type="hidden" id="firstname" name="firstname" value="" />     
				    <input type="hidden" id="lastname" name="lastname" value="" />
				    <input type="hidden" id="email" name="email" value="" />
				    <input type="hidden" id="phone" name="phone" value="" />
				    <input type="hidden" id="address1" name="address1" value="" />
				    <input type="hidden" id="address2" name="address2" value="" />
				    <input type="hidden" id="city" name="city" value=""/>
				    <input type="hidden" id="state" name="state" value=""/>
				    <input type="hidden" id="surl" name="surl" value="http://<?php echo $_SERVER['HTTP_HOST'].'/home/paymentsuccess';?>" />
				    <input type="hidden" id="furl" name="furl" value="http://<?php echo $_SERVER['HTTP_HOST'].'/home/paymentfailed';?>" />
				    <input type="hidden" id="curl" name="curl" value="http://<?php echo $_SERVER['HTTP_HOST'].'/home/paymentcancel';?>" />
				    <input type="hidden" id="udf1" name="udf1" value="{{ $vendorlist }}" />
				    <input type="hidden" id="udf2" name="udf2" value="{{ Session::get('purchase_type') }}" />
				    <input type="hidden" id="udf3" name="udf3" value="" />
				    <input type="hidden" id="udf4" name="udf4" value="" />
				    <input type="hidden" id="udf5" name="udf5" value="" />
				    <input type="hidden" id="hash" name="hash" value="" />
				    <input type="hidden" id="custom_note" name="custom_note" value="Please continue to confirm your order." />
				    <input type="button" value="Place order" class="btn btn-primary right paymnt_order"> 
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.saveorder').click(function(){
			 $('#cartTorder').attr('action','/orders/saveorder');
			 $('#cartTorder').submit();
		});
		$('.continue').click(function(){
		 	$('#payuSubmit').submit();
		});
	});
</script>
@stop
