@extends('layouts.main')

@section('content')
<div class="banner">
  <div class="full-container">
    <div class="slider-content">
      <ul id="pager2" class="container">
      </ul>
      <!-- prev/next links --> 
      
      <span class="prevControl sliderControl"> <i class="fa fa-angle-left fa-3x "></i></span> <span class="nextControl sliderControl"> <i class="fa fa-angle-right fa-3x "></i></span>
      <div class="slider slider-v1" 
      data-cycle-swipe=true
      data-cycle-prev=".prevControl"
      data-cycle-next=".nextControl" data-cycle-loader="wait">

	    <div class="slider-item slider-item-img1"> 
	      <img src="/img/slider/slider0.jpg" class="img-responsive parallaximg sliderImg" alt="img"> 
	    </div>
        
        <div class="slider-item slider-item-img1">
          <div class="sliderInfo"></div>
          <img src="/img/slider/slider1.jpg" class="img-responsive parallaximg sliderImg" alt="img"> 
       	</div>
        <!--/.slider-item-->
        
        <div class="slider-item slider-item-img2 ">
          <div class="sliderInfo"></div>
          <img src="/img/slider/slider3.jpg" class="img-responsive parallaximg sliderImg" alt="img"> </div>
        <!--/.slider-item-->
        
        <div class="slider-item slider-item-img3 ">
          <div class="sliderInfo"></div>
          <img src="/img/slider/slider4.jpg" class="img-responsive parallaximg sliderImg"  alt="img"> 
        </div>
        <!--/.slider-item-->
        
      </div>
      <!--/.slider slider-v1--> 
    </div>
    <!--/.slider-content--> 
    <div class='search_areawise'>
    	{{ Form::open(array('url'=>'home/sendtocity','id'=>'Formsendto','method'=>'get')) }}
    	<div class='resp_font'>Send Flowers To Your Loved Ones Across India</div>
    	<input id='sendtocity' name='sendtocity' class='form-control main-one' placeholder='Please enter the city name'>
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
  </div>
  <!--/.full-container--> 
</div>
<!--/.banner style1-->
<div class="row featuredPostContainer home globalPadding style2">
	<h3 class="section-title style2 text-center">
		<span>NEW ARRIVALS</span>
	</h3>
	<div class="container">
		<div class="row homepage xsResponse">
		@foreach ($products as $product)
		  <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
			  <div class="product">
				 <!--
				 <a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"  data-placement="left">
				 	<i class="glyphicon glyphicon-heart"></i>
				 </a>
				 -->
			    <div class="prod_img image"> 
			      <a href="/home/view/{{$product->id}}">
			      		{{ HTML::image($product->image, $product->title,array('class'=>'img-responsive')) }}
			      </a>		
			      <!--
			      <div class="promotion"> <span class="new-product"> NEW</span> <span class="discount">15% OFF</span> </div>
			      -->
			    </div>
			    <div class='sticker price_det'>{{$product->regular_price}}</div>
			    <div class="description">
			      <h4>{{ HTML::link('home/view/'.$product->id,$product->title) }}</h4>
			      <p>{{ $product->description }}</p>
			      <!-- <span class="size">{{ Availability::display($product->availability)}} </span>  -->
			    </div>
			    <?php 
	    			$r = Product::get_rat($product->vendor_id);

	    			$rat ='';
	    			$msg ='';
	    			$cls ='';

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
			    <div class='vendor_name'>
			    	<div class='ven_nm' style="height: 40px;"><img src='/img/vendor.png' height="20" width="20" />
			    	{{ User::fetch_name($product->vendor_id) }} 
			    	<span style='display:none' class='prod_id'>{{$product->id}}</span>
			    	@if($product->ovid != "")
			    	<span class='more_count'>
			    	<?php
			    		if($product->ovid != ""):
			    			$arr = explode(',', $product->ovid);
			    			unset($arr[0]);
			    			$val = count($arr);
							echo '+'.$val.' deals';
			    		endif;	
			    	?>
			    	</span>
			    	@endif
			    	</div>
			    	<span class='oth_ven'>
			    		<table id='oth_ven_table'>
			    		</table>
			    	</span>
			    	<div class='rating'>
				    	<div class='rat_ved {{ $cls }}'>
				    			{{ round($rat,1) }}
				    		<span>
				    				{{ $msg }}
				    		</span>
				    	</div>
				    	<!-- <div class='count'>26 reviews</div> -->
				    </div>
			    </div>
			    <div class="price"> <span>Rs. {{ $product->regular_price }}</span></div>
			   <!--  {{ Form::open(array('url'=>'home/addtocart?reg=1','id'=>'Formcart')) }}
			    {{ Form::hidden('id' ,$product->id ) }}
			    {{ Form::hidden('quantity' ,'1')  }} -->
			    <div class="action-control"> 
			    	<a href='/home/view/{{$product->id}}' class="atcbtn btn btn-primary"> 
			    		<button type='submit'>
				    		<span class="add2cart">
				    			<i class="glyphicon glyphicon-shopping-cart"> </i> 
				    		</span> 
			    		</button>
			    	</a> 
			    </div>
			    <!-- {{ Form::close() }} -->
			  </div>
		  </div>
		@endforeach  
		</div>
	</div>	
</div>
@stop

@section('pagination')

	<section id='pagination'>
		{{ $products->links() }}
	</section> <!-- end pagination -->

@stop
