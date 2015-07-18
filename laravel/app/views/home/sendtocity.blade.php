@extends('layouts.main')

@section('content')
<div class="container sendtocity"> 
  
  <!-- Main component call to action -->
  <div class="row">
    <div class="breadcrumbDiv col-lg-12">
      <ul class="breadcrumb">
        <li> <a href="/">Home</a> </li>
        <li class="active">{{ucwords(strtolower($city_to_go))}}</li>
      </ul>
    </div>
  </div>
  <!-- /.row  -->
  <div class="row"> 
<!--left column-->
    
    <div class="col-lg-3 col-md-3 col-sm-12">
      <div class="panel-group" id="accordionNo"> 
        <!--Category-->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"> <a data-toggle="collapse"  href="#collapseCategory" class="collapseWill"> <span class="pull-left"> <i class="fa fa-caret-right"></i></span> Category </a> </h4>
          </div>
          <div id="collapseCategory" class="panel-collapse collapse in">
            <div class="panel-body">
              <ul class="nav nav-pills nav-stacked tree">
                @foreach($catnav as $cat)
                  <li> <a href="/home/category/{{ $cat['id'] }}"> <span class="badge pull-right"></span> {{ $cat['name'] }}  </a> </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <!--/City menu end-->
        
       
        
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"> <a data-toggle="collapse"  href="#collapseColor" class="collapseWill"> Color <span class="pull-left"> <i class="fa fa-caret-right"></i></span> </a> </h4>
          </div>
          <div id="collapseColor" class="panel-collapse collapse in">
            <div class="panel-body smoothscroll maxheight300 color-filter">
              <div class="block-element">
                <label>
                  <input type="checkbox" name="tour" value="2" />
                  <small style="background-color:#c00707"></small> Red</label>
              </div>
              <div class="block-element">
                <label>
                  <input type="checkbox" name="tour" value="3" />
                  <small style="background-color:#fff"></small> White </label>
              </div>
              <div class="block-element">
                <label>
                  <input type="checkbox" name="tour" value="3" />
                  <small style="background-color:#5d00dc"></small> Purple</label>
              </div>
              <div class="block-element">
                <label>
                  <input type="checkbox" name="tour" value="3" />
                  <small style="background-color:#f1f40e"></small> Yellow</label>
              </div>
               <div class="block-element">
                <label>
                  <input type="checkbox" name="tour" value="3" />
                  <small style="background-color:#ffc0cb"></small> Pink</label>
              </div>
              <div class="block-element">
                <label> &nbsp; </label>
              </div>
            </div>
          </div>
        </div>
        <!--/color panel end-->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"> <a data-toggle="collapse"  href="#collapseThree" class="collapseWill"> Discount <span class="pull-left"> <i class="fa fa-caret-right"></i></span> </a> </h4>
          </div>
          <div id="collapseThree" class="panel-collapse collapse in">
            <div class="panel-body">
              <div class="block-element">
                <label>
                  <input type="checkbox" name="tour" value="3" />
                  Non-Discounted items </label>
              </div>
              <div class="block-element">
                <label>
                  <input type="checkbox" name="tour" value="3" />
                  Discounted items </label>
              </div>
            </div>
          </div>
        </div>
        <!--/discount  panel end--> 
      </div>
    </div>
    <!--right column-->
    <div class="col-lg-9 col-md-9 col-sm-12">
      <div class="w100 clearfix category-top">
        <h2> {{ ucwords(strtolower($city_to_go)) }}</h2>
        <br/>
        {{ Form::open(array('url'=>'home/sendtocity','id'=>'Formsendto','method'=>'get')) }}
          <span class='changecity'>Change city : </span>
          <input placeholder="Please enter the city name" class="form-control" name="sendtocity" id="sendtocity" value="{{ $city_to_go }}" />
        {{ Form::close() }}
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
      <!--/.category-top-->
      
      <div class="w100 productFilter clearfix">
        <div class="pull-right ">
          <div class="change-order pull-right">
            <select class="form-control" name="orderby">
              <option selected="selected" >Default sorting</option>
              <option value="date">Sort by newness</option>
              <option value="price">Sort by price: low to high</option>
              <option value="price-desc">Sort by price: high to low</option>
            </select>
          </div>
          <!-- <div class="change-view pull-right"> <a href="#" title="Grid" class="grid-view"> <i class="fa fa-th-large"></i> </a> <a href="#" title="List" class="list-view "><i class="fa fa-th-list"></i></a> </div> -->
        </div>
      </div>
      <!--/.productFilter-->
      <div class="row  categoryProduct xsResponse clearfix">
    		@foreach ($products as $product)
    		  <div class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
    			  <div class="product">
    				<div class="prod_img image"> 
    			      <a href="/home/view/{{$product['id']}}?tocity={{$city_to_go}}">
    			      		{{ HTML::image($product['image'], $product['title'],array('class'=>'img-responsive')) }}
    			      </a>
    			    </div>
    			    <div class='sticker price_det'>{{$product['regular_price']}}</div>
    			    <div class="description">
    			      <h4>{{ HTML::link('home/view/'.$product['id'],$product['title']) }}</h4>
    			      <p>{{ $product['description'] }}</p>
    			    </div>
    			    <?php 
    	    			$r = Product::get_rat($product['vendor_id']);

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
    			    	<div class='ven_nm' style="height: 40px;">
    			    	<img src='/img/vendor.png' height="20" width="20" />{{ User::fetch_name($product['vendor_id']) }} 
    			    	<span style='display:none' class='prod_id'>{{$product['id']}}</span>
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
    				    </div>
    			    </div>
    			    <div class="price"> <span>Rs. {{ $product['regular_price'] }}</span></div>
    			    <div class="action-control"> 
    			    	<a href='/home/view/{{$product["id"]}}' class="atcbtn btn btn-primary"> 
    			    		<button type='submit'>
    				    		<span class="add2cart">
    				    			<i class="glyphicon glyphicon-shopping-cart"> </i> 
    				    		</span> 
    			    		</button>
    			    	</a> 
    			    </div>
    			  </div>
    		  </div>
    		@endforeach 
      <!--/.categoryProduct || product content end-->
      
      <div class="w100 categoryFooter">
        <div class="pagination pull-left no-margin-top">
         <section id='pagination'>
    			<section id='pagination'>
    				{{ $links->appends(array('city' => $city_to_go))->links() }}
    			</section> <!-- end pagination -->
    		 </section> <!-- end pagination -->
        </div>
      </div>
      <!--/.categoryFooter--> 
    </div>
    <!--/right column end--> 
</div>
  <!-- /.row  --> 
</div>    
<!--/.banner style1-->
<!-- <div class="row featuredPostContainer globalPadding style2">
	<h3 class="section-title style2 text-center">
		<span><?php  ?></span>
	</h3>
	<div class="container">
		<div class="row homepage xsResponse">
		 
		</div>
	</div>	
</div> -->
@stop

@section('pagination')

	<section id='pagination'>
		{{ $links->appends(array('city' => $city_to_go))->links() }}
	</section> <!-- end pagination -->

@stop
