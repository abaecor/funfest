@extends('layouts.main')

@section('content')

<div class="container cat_list"> 
  
  <!-- Main component call to action -->
  <div class="row">
    <div class="breadcrumbDiv col-lg-12">
      <ul class="breadcrumb">
        <li> <a href="/">Home</a> </li>
        <li class="active">{{$category_selected->name}}</li>
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
        <!--/Category menu end-->
        
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"> <a class="collapseWill" data-toggle="collapse"  href="#collapsePrice"> Price <span class="pull-left"> <i class="fa fa-caret-right"></i></span> </a> <span class="pull-right clearFilter  label-danger"> Clear </span> </h4>
          </div>
          <div id="collapsePrice" class="panel-collapse collapse in">
            <div class="panel-body priceFilterBody"> 
             {{ Form::open(array('url'=>'home/filterprice','id'=>'priceflter')) }}
             {{ Form::hidden('cat_id' ,$category_selected->id) }}	
              <!-- -->
              <?php $chk = 'false';?>
              
              @for ($i=0; $i < 7; $i++)

              	@if(isset($price_set) && $price_set == $i)
              		<?php $chk = true;?>
              	@else
              		<?php $chk = false;?>	
              	@endif
				      @if($i == 6)
              	@if($chk)
	              		<label>
		                <input type="radio" name="price" value="{{$i}}" checked/>
		                	3000 & above
		              	</label>
		            @else
		            	<label>
		                <input type="radio" name="price" value="{{$i}}"/>
		                	3000 & above
		              	</label>
		              	<br> 
		            @endif  	 	
              	@else
              		@if($chk)
		              	<label>
		                <input type="radio" name="price" value="{{$i}}" checked/>
		                	Rs. {{ $z = 500*$i}} - {{$z+500}}
		              	</label>
		              	<br>
	              	@else
	              		<label>
		                <input type="radio" name="price" value="{{$i}}"/>
		                	Rs. {{ $z = 500*$i}} - {{$z+500}}
		              	</label>
		              	<br>
	              	@endif
	            @endif  	
              @endfor
              <hr>
              <p>Enter a Price range </p>
              <form class="form-inline " role="form">
                <div class="form-group">
                  <input type="text" class="form-control pull-left" name='from_price' id="from_price" placeholder="min" value="{{$rmin}}">
                </div>
                <div class="form-group sp pull-left"> - </div>
                <div class="form-group">
                  <input type="text" class="form-control pull-left" name='to_price' id="to_price" placeholder="max" value="{{$rmax}}">
                </div>
                <button type="submit" class="btn btn-primary pull-right">Go</button>
              {{Form::close()}}  
              </form>
            </div>
          </div>
        </div>
        <!--/price panel end-->
        
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
        <!-- <h2> {{$category_selected->name}}</h2> -->
        <br/>
        <?php $uri = Request::url(); ?>
        {{ Form::open(array('url'=>$uri,'id'=>'Formsendto','method'=>'get')) }}
          <span class='changecity'>Change city : </span>
          <input placeholder="Please enter the city name" class="form-control" name="city" id="sendtocity" value="{{ $city_to_go }}" />
          @if($category_selected->id == 15)
          <input type='hidden' name="kg" value="{{ $kg }}" />
          @endif
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
        <div class="categoryImage top30"> 
          <h1 style="">{{$category_selected->name}}</h1>
          <!-- <img src="/img/valentines.jpg" class="img-responsive" alt="img"> </div> -->
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
          <div class="change-view pull-right"> <a href="#" title="Grid" class="grid-view"> <i class="fa fa-th-large"></i> </a> <a href="#" title="List" class="list-view "><i class="fa fa-th-list"></i></a> </div>
        </div>
      </div>
      <!--/.productFilter-->
      <div class="row  categoryProduct xsResponse clearfix">
        @if($nodata)
            @foreach ($products as $product)
                  <div class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <div class="product">
                    <div class="prod_img image">
                        <a href="/home/view/{{$product['id']}}">
                            {{ HTML::image($product['image'], $product['title'],array('width'=>200,'height'=>"auto")) }}
                        </a>
                      <!-- <div class="promotion"> <span class="new-product"> NEW</span> <span class="discount">15% OFF</span> </div> -->
                    </div>
                    <div class='sticker price_det'>
                    @if(isset($price) && $price == "delux_price")
                      {{$product['delux_price']}}
                    @else
                      {{$product['regular_price']}}
                    @endif
                    </div>
                    <div class="description">
                      <h4>{{ HTML::link('home/view/'.$product['id'],$product['title']) }}</h4>
                      <p>
                      @if($category_selected->id == 15)
                        {{ $kg." kg Cake"}}
                      @else
                        {{ $product['description'] }}
                      @endif
                      </p>
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
                      <div class='ven_nm'>
                      <img src='/img/vendor.png' height="20" width="20" />{{ User::fetch_name($product['vendor_id']) }}
                      <span style='display:none' class='prod_id'>{{$product['id']}}</span>
                      @if(isset($product['ovid']) && $product['ovid'] != "")
                      <span class=''>
                      <?php
                        if($product['ovid'] != ""):
                          $arr = explode(',', $product['ovid']);
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
                      </div>
                    </div>
                    <div class="price">
                    <span>
                    Rs.
                    @if(isset($price) && $price == "delux_price")
                      {{$product['delux_price']}}
                    @else
                      {{$product['regular_price']}}
                    @endif
                    </span></div>
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
      			{{ $links->links() }}
      		 </section> <!-- end pagination -->
          </div>
        </div>
        <!--/.categoryFooter-->
      @endif
      </div>
    <!--/right column end--> 
  </div>
  <!-- /.row  --> 
</div>
@stop

