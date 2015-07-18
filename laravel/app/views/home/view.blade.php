@extends('layouts.main')

@section('content')

<!-- styles needed by smoothproducts.js for product zoom  -->
<link rel="stylesheet" href="/css/smoothproducts.css">
<style type="text/css">
  #ui-datepicker-div{
    top:15%!important;
  }
</style>
<!-- styles needed by mCustomScrollbar -->
<link href="/css/jquery.mCustomScrollbar.css" rel="stylesheet">



  <div class="row transitionfx product_view">
      @if($nodata)
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="main-image sp-wrap col-lg-12 no-padding"> 
        <a href="/{{$product->image}}">{{ HTML::image($product->image, $product->title,array('class'=>'img-responsive')) }}</a> 
      </div>
      @if(!$guest_user && $super)
      <div class='edit'>
        Edit
      </div>
      @endif
      <div class="product-tab w100 clearfix" style="margin-top: 10px;">
      
        <ul class="nav nav-tabs">
          <li class="active"><a href="#details" data-toggle="tab">Description</a></li>
       </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="details">
            {{$product->description}}
          </div>
        </div> <!-- /.tab content -->
      </div><!--/.product-tab-->
      @if(!empty($other_ven))
          <div class="othervendet">
           <ul class="nav nav-tabs">
              <li class="active"><a href="#details" data-toggle="tab">More Deals</a></li>
           </ul>
              <table class='table table-striped'>
                <tr>
                    <th>Vendor</th>
                    <th>Regular</th>
                    <th>Delux</th>
                    <th>Premium</th>
                    <th class="center">Ratings</th>
                    <th class="center">select</th>
                </tr>
                @foreach ($other_ven as $value)
                    <tr>
                        <td>{{ User::fetch_name($value->vendor_id) }}</td>
                        <td> {{ $value->regular_price }} </td>
                        <td> {{ $value->delux_price }} </td>
                        <td> {{ $value->premium_price }} </td>
                        <td><?php 
                          $r = Product::get_rat($value->vendor_id);
                          if($r == ''){
                            $rat = 'N/A';
                          }else{
                            $rat = $r;
                          }
                          if($r >= 4){
                            $msg = 'Excellent';
                            $cls = 'dkgrn';
                          }elseif($r >= 3){
                            $msg = 'Great';
                            $cls = 'grn';
                          }elseif($r >= 2){
                            $msg = 'Good';
                            $cls = 'yellow';
                          }elseif($r >= 1){
                            $msg = 'Average';
                            $cls = 'lgtyellow';
                          }elseif($r > 0){
                            $msg = 'Ok';
                            $cls = 'orange';
                          }elseif($r == ''){
                            $msg = 'Not rated';
                            $cls = 'red';
                          }
                        ?>
                          <div class='rating'>
                            <div class='rat_ved {{ $cls }}'>
                                {{ round($rat,1) }}
                            </div>
                            <!-- <div class='count'>26 reviews</div> -->
                          </div>
                        </td>
                        <td class="center">
                          <label class='fancyradio'></label>
                            {{ Form::radio('vendor_sel',$value->vendor_id,false,array('class'=>'radiobtn reg')) }}
                        </td>
                    </tr>
                @endforeach
              </table>
          </div>
          @endif
    </div>
   <!--/ left column end -->

    
    
    <!-- right column -->
    <div class="col-lg-6 col-md-6 col-sm-5">
      
      <h1 class="product-title"> {{$product->title}}</h1>
      @if(count($other_ven) > 1)
        <div class='hide venlist'>
              <?php
                  echo "<ul>";
                  // foreach ($other_ven as $key => $value) {
                  //    echo "<li>".$value['description']."::"
                  //            .$value['city']."::"
                  //            .$value['regular_price']."::"
                  //            .$value['delux_price']."::"
                  //            .$value['premium_price']."</li>";
                  // }
                  echo "</ul>";
              ?>
          </div>
      @endif
      <h3 class="product-code">Product Code : {{$product->product_code}}</h3>
      <div class="product-price"> 
          <span class="price-sales"> Rs <span class='rg'>{{$product->regular_price}}</span>
                                        <span class='dx'>{{$product->delux_price}}</span>
                                        <span class='pr'>{{$product->premium_price}}</span>
          </span> 
      </div>
      
      <div class="details-description">
        <p>{{$product->description}} </p>
      </div>
      
      <div class="color-details"> 
        <span class="selected-color"><strong>Variants</strong></span>
        <ul class="swatches Color">
          <li class="selected">{{ Form::radio('price','1',false,array('class'=>'radiobtn reg')) }} Regular </li>
          <li> {{ Form::radio('price','1',false,array('class'=>'radiobtn dlx')) }} Delux </li>
          <li> {{ Form::radio('price','1',false,array('class'=>'radiobtn pri')) }} Premium </li>
        </ul>
        <div class='price_det'> 
          <span class='rg'>  Regular price {{$product->regular_price}}</span>
          <span class='dx'>  Delux price {{$product->delux_price}}</span>
          <span class='pr'>  Premium price {{$product->premium_price}}</span>
        </div>
      </div>
      <!--/.color-details-->
      {{ Form::open(array('url'=>'home/addtocart?reg=1','id'=>'Formcart')) }}
      <div class="productFilter">
        <div class="filterBox">
            <!-- <label>Delivery</label> -->
            <input name='delivery_date' class='form-control input-md' placeholder="Set delivery date" id='datepicker'>
            <!--<i class="fa fa-calendar"> </i>-->
        </div>
      </div>
      <!-- productFilter -->
      <div class="productFilter addons_slider">
        <strong>Addons</strong>
        @if(count($addon_items) != 0)
          <div id="SimilarProductSlider">
          @foreach ($addon_items as $k=>$aitem) 
          <div class="item">
            <div class="addons"> 
              <a class="/home/view/{{$aitem->id}}">{{ HTML::image($aitem->image, $aitem->title)}} </a>
              <div class="description">
                <h4>{{$aitem->description}}</h4>
                {{Form::checkbox('aid['.$k.']',$aitem->id)}}
                <div class="price"> <span>{{$aitem->price}}</span> </div>
              </div>
            </div>
          </div>
          @endforeach
          </div>
        @else
          <div>No Addons to display</div>
        @endif  
      </div>
      <div class="cart-actions">
        <div class="addto">
          {{ Form::hidden('quantity' ,'1') }}
          {{ Form::hidden('id' ,$product->id ) }}
          {{ Form::hidden('reg_price' ,$product->regular_price,array('id'=>'reg_price')) }}
          {{ Form::hidden('dlx_price' ,$product->delux_price,array('id'=>'dlx_price') ) }}
          {{ Form::hidden('prm_price' ,$product->premium_price,array('id'=>'prm_price') ) }}
          {{ Form::hidden('city_cart' ,$product->city,array('id'=>'city_cart') ) }}
          {{ Form::hidden('vend_id' ,$product->vendor_id,array('id'=>'vend_id') ) }}
          <button type='submit' class='button btn-cart cart first'>
            Add to cart
          </button>
        </div>  
        <div style="clear:both"></div>
      </div>
      {{ Form::close() }}
      <!--/.cart-actions-->
      
      <div class="clear"></div>
      <div style="clear:both"></div>
      
      <div class="product-share clearfix">
        <p> SHARE </p>
        <div class="socialIcon"> 
        	<a href="#"> <i  class="fa fa-facebook"></i></a> 
            <a href="#"> <i  class="fa fa-twitter"></i></a> 
            <a href="#"> <i  class="fa fa-google-plus"></i></a> 
            <a href="#"> <i  class="fa fa-pinterest"></i></a> 
        </div>
      </div>
      <br/><br/>
      <p>CUSTOMER REVIEWS</p>  
      <div class="testimonials-slider clearfix">
        <div class="slide">
              <div class="testimonials-carousel-thumbnail"></div>
                  <div class="testimonials-carousel-context">
                  <div class="testimonials-name">J J Khan <span>Great service</span></div>
                  <div class="testimonials-carousel-content"><p>Delivered in time. Perfection in service. Great work</p></div>
              </div>
        </div>
             
        <div class="slide">
              <div class="testimonials-carousel-thumbnail"></div>
                  <div class="testimonials-carousel-context">
                  <div class="testimonials-name">Jeff Martin <span>Value for money</span></div>
                  <div class="testimonials-carousel-content"><p>What you see is what you get.</p></div>
              </div>
        </div>
             
        <div class="slide">
              <div class="testimonials-carousel-thumbnail"></div>
                  <div class="testimonials-carousel-context">
                  <div class="testimonials-name">Jemmy Rownlands <span>Perfect</span></div>
                  <div class="testimonials-carousel-content"><p>Delivered in time. Quality is fresh. thumbs up</p></div>
              </div>
        </div>
             
      </div>
      <!--/.product-share--> 
      
    </div><!--/ right column end -->
      @else
          <h1 style="text-align: center; margin-top: 15%;">Sorry no products for this city.</h1>
      @endif
  </div>
  
  @if(isset($city_list))
  <div class="mandatory_city">
      <div class='search_areawise'>
        {{ Form::open(array('url'=>'home/view/'.$product->id,'id'=>'Formsendto','method'=>'get')) }}
        <div class='resp_font'>Send Flowers To Your Loved Ones Across India</div>
        <input id='sendtocity' name='tocity' class='form-control main-one' placeholder='Please enter the city name'>
        <a class="btn btn-danger btn-lg"><button type='submit'>SHOP<span class="arrowUnicode">►</span></button></a>
        {{Form::close()}}
        <div class='city_option' style='display:none;'>
        <ul>
          <li class='nomatches'>No matches</li>
            <?php
              
              foreach ($city_list as $key => $value) {
                echo '<li>'.$value['name'].'</li>';
               }  
            ?>
        </ul> 
      </div>
    </div>
  </div> <!-- mandatory city-->
  @endif
  <!--/.row-->
  <div style="clear:both"></div>
<script type="text/javascript" src="/js/smoothproducts.min.js"></script> 

	<script type="text/javascript">
		$(document).ready(function(){
      $('.sp-thumbs a:first-child').trigger('click');
      $('.sp-thumbs a:first-child').hide();
      $('.dx,.pr').hide();
			$('.reg').trigger('click');
      $('.swatches li').click(function(){
          i = $(this).index();
          if(i == 0){
            $('.rg').show();
            $('.dx,.pr').hide();
          }else if(i == 1){
            $('.dx').show();
            $('.rg,.pr').hide();
          }else if(i == 2){
            $('.pr').show();
            $('.dx,.rg').hide();
          }
      });
       var array = ["2015-02-14"];

      $('#datepicker').datepicker({
          beforeShowDay: function(date){
              var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
              return [ array.indexOf(string) == -1 ]
          },
          minDate: 0
      }).on('changeDate', function(ev){
          $(this).datepicker('hide');
      });
      // $('.datepicker').css('left','83%');
      // $('.datepicker').css('top','46%');
			$('.radiobtn').click(function(){
				if($(this).prop('checked')){
			      if($(this).hasClass('pri')){
			      	$('#Formcart').attr('action','/home/addtocart?pri=1');
			      }
			      if($(this).hasClass('dlx')){
			      	$('#Formcart').attr('action','/home/addtocart?dlx=1');
			      }
			      if($(this).hasClass('reg')){
			      	$('#Formcart').attr('action','/home/addtocart?reg=1');
			      }
			    }
			}); 
		});
	</script>
@stop