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
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="main-image sp-wrap col-lg-12 no-padding"> 
        <a href="/{{$cake['image']}}">{{ HTML::image($cake['image'], $cake['title'],array('class'=>'img-responsive')) }}</a> 
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
            {{$cake['description']}}
          </div>
        </div> <!-- /.tab content -->
      </div><!--/.product-tab-->
    </div>
   <!--/ left column end -->
    
    
    <!-- right column -->
    <div class="col-lg-6 col-md-6 col-sm-5">
      
      <h1 class="product-title"> {{$cake['title']}}</h1>
      <!-- if(count($other_ven) > 1) -->
          <!-- <div class='hide venlist'>
                <?php
                    /*echo "<ul>";
                    foreach ($other_ven as $key => $value) {
                       echo "<li>".$value['description']."::"
                               .$value['city']."::"
                               .$value['regular_price']."::"
                               .$value['delux_price']."::"
                               .$value['premium_price']."</li>";
                    }
                    echo "</ul>";
                    */
                ?>
            </div> -->
      <!-- endif -->
      <h3 class="product-code">Product Code : {{$cake['product_code']}}</h3>
      <div class="product-price"> 
          <span class="price-sales"> Rs <span class='rg'>{{$cake['price']}}</span>
          </span> 
      </div>
      
      <div class="details-description">
        <p>{{$cake['description']}} </p>
      </div>
      
      {{--<div class="color-details"> --}}
        {{--<span class="selected-color"><strong>Variants</strong></span>--}}
        {{--<ul class="swatches Color">--}}
          {{--<li class="selected">{{ Form::radio('price','1',false,array('class'=>'radiobtn reg')) }} Price </li>--}}
        {{--</ul>--}}
        {{--<div class='price_det'> --}}
          {{--<span class='rg'>  Price {{$cake['price']}}</span>--}}
        {{--</div>--}}
      {{--</div>--}}
      <!--/.color-details-->
      {{ Form::open(array('url'=>'cake/addtocart','id'=>'Formcart')) }}
      <div class="productFilter">
        <div class="filterBox">
            <!-- <label>Delivery</label> -->
            <input name='delivery_date' class='form-control input-md' placeholder="Set delivery date" id='datepicker'>
            <!--<i class="fa fa-calendar"> </i>-->
        </div>
      </div>
      <!-- productFilter -->
      <div class="cart-actions">
        <div class="addto">
          {{ Form::hidden('quantity' ,'1') }}
          {{ Form::hidden('id' ,$cake['id'] ) }}
          {{ Form::hidden('price' ,$cake['price'],array('id'=>'price')) }}
          {{ Form::hidden('city_cart' ,$cake['city'],array('id'=>'city_cart') ) }}
          {{ Form::hidden('vend_id' ,$cake['vendor_id'],array('id'=>'vend_id') ) }}
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
    
  </div>
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
      $('#datepicker').datepicker({minDate: 0}).on('changeDate', function(ev){
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