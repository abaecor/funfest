@extends('layouts.main')

@section('content')
	<h3 class="section-title style2 text-center">
		<span>Search Results for {{ $keyword }}</span>
	</h3>
	<div class="container">
		<div class="row xsResponse">
		@foreach ($products as $product)
			<div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
			  <div class="product">
				 <!--
				 <a class="add-fav tooltipHere" data-toggle="tooltip" data-original-title="Add to Wishlist"  data-placement="left">
				 	<i class="glyphicon glyphicon-heart"></i>
				 </a>
				 -->
			    <div class="image"> 
			      <a href="/home/view/{{$product->id}}">
			      		{{ HTML::image($product->image, $product->title,array('class'=>'img-responsive')) }}
			      </a>		
			      <!--
			      <div class="promotion"> <span class="new-product"> NEW</span> <span class="discount">15% OFF</span> </div>
			      -->
			    </div>
			    <div class="description">
			      <h4>{{ HTML::link('home/view/'.$product->id,$product->title) }}</h4>
			      <p>{{ $product->description }}</p>
			      <span class="size">{{ Availability::display($product->availability)}} </span> </div>
			    <div class="price"> <span>Rs. {{ $product->regular_price }}</span></div>
			    {{ Form::open(array('url'=>'home/addtocart?reg=1','id'=>'Formcart')) }}
			    {{ Form::hidden('id' ,$product->id ) }}
			    {{ Form::hidden('quantity' ,'1') }}
			    <div class="action-control"> 
			    	<a class="atcbtn btn btn-primary"> 
			    		<button type='submit'>
				    		<span class="add2cart">
				    			<i class="glyphicon glyphicon-shopping-cart"> </i> 
				    			Add to cart
				    		</span> 
			    		</button>
			    	</a> 
			    </div>
			    {{ Form::close() }}
			  </div>
		   </div>
		@endforeach
		</div>
	</div>	
@stop

@section('pagination')

	<section id='pagination'>
		{{ $products->appends(array('keyword' => $keyword))->links() }}
	</section> <!-- end pagination -->

@stop
