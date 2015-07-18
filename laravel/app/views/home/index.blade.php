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
    	<div class="toggle-btn">
    		<span class="flower selected">Flowers</span>
			<span class="cake ">Cake</span>
			<input type="text" value="flower" name="sendtype" id="sendtype">
    	</div>
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
		<img src="/img/infograph.png"/><br/>
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


	<section id='pagination'>
		{{ $products->links() }}
	</section> <!-- end pagination -->

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border: 1px solid rgb(224, 224, 224); padding: 18px; margin-bottom: 25px;">

<h1 style="font-size: 22px; font-weight: normal;">Order Flowers, Gifts & Cakes Online with Little Florist</h1>

Little Florist was established with a sole aim to provide fresh flowers and render exceptional flower arrangement services. Little Florist, with stores all over India, delivers flowers, gifts and cakes in all cities. It is the only Indian brand that stands parallel to international flowers brands in terms of quality as well as designs. Whether it is official functions, weddings, receptions, anniversaries or birthday parties, Little Florist can fulfill all types of flower and gifts requirements to make your special day even more special. Having physical as well as online presence, it makes sending flowers to India or abroad convenient and hassle-free. Understanding the importance of timely delivery, Little Florist keeps on strengthening its distribution system to send flowers to India or outside within the time.
<br/>
Having more than 7 years of experience in flower delivery and decorations, Little Florist is considered an imperative part of every celebration. Being a one-stop solution for each of your floral needs, it strives to make available even the rarest of the rare flowers. No matter where you reside, Little Florist puts in sincere efforts to deliver flowers timely to your loved ones. Little Florist, a leading florist in India, gives you a choice to buy fresh or artificial flowers, in addition to a range of exotic chocolates, cakes and sweets. Our wide distribution network and strong physical & online presence make us the best option to send gifts to India and across the globe.
<br/>
Little Florist provides online flower delivery service all over India & world. If you are looking for fresh flower delivery service in India, or you want to send flowers to Delhi, Mumbai, Bangalore, Hyderabad and any other part of India with same day delivery, then Little Florist is your ideal destination. We send cakes to India for all occasions including birthdays, anniversaries, New Year, Valentine's Day, Mother's Day and Father's Day. 
<br/>
Little Florist, one the famous names in florist industry, offers you fresh flowers and gifts for all occasions. If you are planning to send birthday flowers, anniversary flowers, mother's day flowers and father's day flowers with same day delivery in Delhi, Mumbai, Bangalore, Pune, Noida, Faridabad, Gurgaon and any other place in India, visit <a href="www.littleflorist.com" title="Gift flowers & cakes">www.littleflorist.com</a> and choose the type of flowers you want to send. We deliver flowers and gifts on the date and time mentioned by you. We also provide services for midnight, fix time, next day and same day delivery of flowers, gifts and cakes for all occasions.

</div>
@stop
