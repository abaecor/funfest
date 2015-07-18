@extends('layouts.main')

@section('content')
<div class="row transitionfx order_view">
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="main-image sp-wrap col-lg-12 no-padding"> 
        <a href="/{{$order['prod_details']['image']}}">{{ HTML::image($order['prod_details']['image'], $order['prod_details']['title'],array('class'=>'img-responsive')) }}</a> 
      </div>
      
      <div class="product-tab w100 clearfix" style="margin-top: 10px;">
      
        <ul class="nav nav-tabs">
          <li class="active"><a href="#details" data-toggle="tab">Description</a></li>
       </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="details">
            {{$order['prod_details']['description']}}
          </div>
        </div> <!-- /.tab content -->
        
      </div><!--/.product-tab-->
    </div>
   <!--/ left column end -->
    <div class="col-lg-6 col-md-6 col-sm-5">
        <h1 style="text-align:center;">Order details</h1>
        <div class='orderinfo'>
          <h4>Basic order</h4>
          <ul>
          <li>Order id - {{ $order['order_id'] }} </li>
          <li>Vendor name - {{ $ven_name = User::fetch_name($order['vendor_id']); }}</li>
          <li>Order Date/Time  - {{ $order['created_at'] }}</li>
          <li>Total Bill value  - {{ $order['price'] }}<br/>Customer's phone number<br/></li>
          <li><i class="glyphicon glyphicon-phone-alt"> </i> {{ $order['contact'] }}</li>
          </ul>
        </div>
        @if(!empty($addon_det))
        <div class='orderinfo'>
            <h4>Addons added</h4>
                @foreach($addon_det as $value)
                <div class="inline-items pull-left">
                    <div class="li-image"> {{ HTML::image($value['image']) }} </div>
                    <div class="li-description"> {{ $value['description'] }} </div>
                    <div class="li-price"> {{ $value['price'] }} </div>
                </div>
                @endforeach
            <span style="font-size: 11px;">*All prices included in total bill value.</span>
        </div>
        @endif
        <div class='orderinfo'>
          <h4>Shipping Details</h4>
          <ul>
          <li>Name  - {{ $order['name'] }}</li>
          <li>Address - {{ $order['shipping_address'] }}  </li>
          <li>Zip - {{ $order['shipping_zip'] }}</li>
          <li>Contact  - {{ $order['contact'] }}</li>
          </ul>
          <hr/>
          <br/>
          <h4>Message</h4>
          <ul>
              <li>{{ $order['user_message'] }}</li>
          </ul>
        </div>
        <?php $orderstats = $order['status'];?>
        <div class="orderinfo">
          <h2>Status </h2>
          <h3><?php $st = ($orderstats == 'neworder') ? 'Under process' : $orderstats; echo $st;?></h3>
        </div>
    </div>
    
  </div>
@stop
