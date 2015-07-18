@extends('layouts.main')

@section('content')
<div class="container cake cat_list"> 
  
  <!-- Main component call to action -->
  <div class="row">
    <div class="breadcrumbDiv col-lg-12">
      <ul class="breadcrumb">
        <li> <a href="/">Home</a> </li>
        <li class="active">Cake - {{$category_selected}}</li>
      </ul>
    </div>
  </div>
  <!-- /.row  -->
  <div class="row"> 
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="w100 clearfix category-top">
        <h2> <?php echo ($category_selected == 'all') ?  ucfirst($category_selected)." Cakes" :  ucfirst($category_selected)." Kg Cakes"; ?></h2>
        <br/>
        <?php $uri = Request::url(); ?>
        {{ Form::open(array('url'=>'cake/index?size='.Session::get('category_selected'),'id'=>'Formsendto','method'=>'get')) }}
          <span class='changecity'>Change city : </span>
          <input placeholder="Please enter the city name" class="form-control" name="tocity" id="sendtocity" value="{{ $tocity }}" />
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
          <div class="change-view pull-right"> <a href="#" title="Grid" class="grid-view"> <i class="fa fa-th-large"></i> </a> <a href="#" title="List" class="list-view "><i class="fa fa-th-list"></i></a> </div>
        </div>
      </div>
      <!--/.productFilter-->
      <div class="row  categoryProduct xsResponse clearfix">
        @foreach ($cakes as $key => $cake)
          <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
  		        <div class="product">
  	            <div class="prod_img image"> 
                    <a href="/cake/view/{{$cake[0]['id']}}">
  	              		{{ HTML::image($cake[0]['image'], $cake[0]['title'],array('width'=>200,'height'=>"auto")) }}
  	              	</a>
  	              <!-- <div class="promotion"> <span class="new-product"> NEW</span> <span class="discount">15% OFF</span> </div> -->
  	            </div>
                <div class='sticker price_det'>
                  {{$cake[0]['price']}}  
                </div>
                <div class="description">
  	              <h4>{{ HTML::link('home/view/'.$cake[0]['id'],$cake[0]['title']) }}</h4>
  	              <p>
                  {{ $cake[0]['description'] }}
                  </p>
  	            </div>
                 <?php 
                  $r = Product::get_rat($cake[0]['vendor_id']);

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
                    <img src='/img/vendor.png' height="20" width="20" />{{ User::fetch_cakevendor_name($cake[0]['vendor_id']) }} 
                    <span style='display:none' class='prod_id'>{{$cake[0]['id']}}</span>
                    <?php
                    if(count($cake) > 1){
                      echo '<span class="deals">+'.count($cake).' deals</span>';
                    }
                    ?>
                  </div>
                  <span class='oth_ven'>
                    <table id='oth_ven_table'>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Type</th>
                      </tr>
                    @foreach($cake as $k=>$v)
                      <tr>
                        <td>{{ $v['title']}}</td>
                        <td>{{$v['price']}}</td>
                        <td>{{$v['type']}} kg</td>
                      </tr>
                    @endforeach  
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
                    {{$cake[0]['price']}}  
                  </span>
                </div>
                <div class="action-control"> 
                  <a href='/cake/view/{{$cake[0]["id"]}}' class="atcbtn btn btn-primary"> 
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
      </div>
    <!--/right column end--> 
  </div>
    @if($tocity == "")
      <div class="mandatory_city">
          <div class='search_areawise'>
              {{ Form::open(array('url'=>'cake/index?size='.Session::get('category_selected'),'id'=>'Formsendto','method'=>'get')) }}
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
  <!-- /.row  --> 
</div>

@stop