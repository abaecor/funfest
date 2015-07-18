@extends('layouts.main')

@section('content')
	<div class="col-lg-12 col-md-9 col-sm-7 myaccount">
      <h1 class="section-title-inner"><span><i class="fa fa-unlock-alt"></i> My account </span></h1>
      <div class="row userInfo">
        <div class="col-xs-12 col-sm-12">
          <h2 class="block-title-2"><span>Welcome to little florist. Here you can manage all of your personal information and orders.</span></h2>
          <ul class="myAccountList row">
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
              <div class="thumbnail equalheight" style="height: 116px;"> 
              	@if($super)
	              <a href="/admin/orders/index?super=1" title="Orders">
		          	<i class="fa fa-barcode"></i> Order history 
		          </a> 
	            @elseif($vendor)
	              <a href="/admin/orders/index?vendor=1" title="Orders">
		          	<i class="fa fa-barcode"></i> Order history 
		          </a> 
	            @else
	              <a href="/admin/orders/index" title="Orders">
		          	<i class="fa fa-barcode"></i> Order history 
		          </a>
	            @endif
              </div>
            </li>
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
              <div class="thumbnail equalheight" style="height: 116px;"> <a href="/users/edit/{{ $user_id }}" title="Personal information"><i class="fa fa-user"></i> Personal information</a> </div>
            </li>
            @if(Session::get('user_status') == 'vendor')
	            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
	              <div class="thumbnail equalheight" style="height: 116px;"> <a href="/users/myaddress" title="My addresses"><i class="fa fa-home"></i> My addresses</a> </div>
	            </li>
	            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
	              <div class="thumbnail equalheight" style="height: 116px;"> <a href="/admin/users/addaddress/{{ $user_id }}" title="Add  address"> <i class="fa fa-map-marker"> </i> Add  address</a> </div>
	            </li>
	            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
	              <div class="thumbnail equalheight" style="height: 116px;"> <a href="/admin/products/index" title="Personal information"><i class="fa fa-edit"></i> Add products</a> </div>
	            </li>
	            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
	              <div class="thumbnail equalheight" style="height: 116px;"> <a href="/admin/products/viewall/{{ $user_id }}" title="Personal information"><i class="fa fa-edit"></i> Edit a product</a> </div>
	            </li>
            @endif
            @if(Session::get('user_status') == 'super')
            	<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
	              <div class="thumbnail equalheight" style="height: 116px;"> 
	              	<a href="/admin/products/viewall" title="My addresses">
	              		<i class="fa fa-th-list"></i> Product list
	              	</a>
	              </div>
	            </li>
	            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
	              <div class="thumbnail equalheight" style="height: 116px;"> 
	              	<a href="/admin/products/index" title="Add  address"> 
	              		<i class="fa fa-edit"> </i> Add products
	              	</a> 
	              </div>
	            </li>
	            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
	              <div class="thumbnail equalheight" style="height: 116px;">
	              	 <a href="/admin/users/viewall" title="Personal information">
	              	 	<i class="fa fa-th-list"></i> Vendor list
	              	 </a>
	              </div>
	            </li>
	            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
	              <div class="thumbnail equalheight" style="height: 116px;"> 
	              	<a href="/users/newaccount?type=vendor" title="Personal information">
	              		<i class="fa fa-user"></i> Add vendor
	              	</a> 
	              </div>
	            </li>
	            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
	              <div class="thumbnail equalheight" style="height: 116px;">
	               <a href="/admin/coupons/addcoupons" title="Personal information">
	               		<i class="fa fa-tag"></i> Add Coupons
	               </a>
	              </div>
	            </li>
	             <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
	              <div class="thumbnail equalheight" style="height: 116px;">
	               <a href="/admin/coupons/viewall" title="Personal information">
	               		<i class="fa fa-tags"></i> View coupon list
	               </a>
	              </div>
	            </li>
            @endif
            <!-- <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
              <div class="thumbnail equalheight" style="height: 116px;"> <a href="wishlist.html" title="My wishlists"><i class="fa fa-heart"></i> My wishlists </a> </div>
            </li> -->
          </ul>
          <div class="clear clearfix"> </div>
        </div>
      </div>
      <!--/row end--> 
      <div>
      		{{ Form::open(array('url' => 'home/updaterates')) }}
      		{{ Form::label("rate", "Enter rate to increase... ") }}
      		{{ Form::input("text", "rate", Auth::user()->rate_upraised, array('class'=>'form-control input-md')) }}
      		{{ Form::submit("Submit", array('class'=>'btn btn-primary'))	}}
      		{{ Form::close() }}
      </div>
      
    </div>
@stop