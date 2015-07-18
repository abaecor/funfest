{{
  Form::macro('search', function($name,$value,$class,$placeholder) {
    return '<input type="search" name="'.$name.'" class="'.$class.'" placeholder="'.$placeholder.'" value="'.$value.'"/>';
  });
 Form::macro('custompass', function($name,$value,$class,$placeholder,$id) {
    return '<input type="password" id="'.$id.'" name="'.$name.'" class="'.$class.'" placeholder="'.$placeholder.'" value="'.$value.'"/>';
  });
}}
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
<link href='http://fonts.googleapis.com/css?family=Cedarville+Cursive' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="/ico/favicon.png">
<title>Funfest - send flowers to all cities in India</title>
<meta name="description" content="send flowers across india gift flowers">
<meta name="keywords" content="flowers ,cake,florists,gifts, online, delivery, bouquet, india, delhi, bangalore, mumbai">
<!-- Bootstrap core CSS -->
<link href="/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/css/style.css" rel="stylesheet">

<!-- css3 animation effect for this template -->
<link href="/css/animate.min.css" rel="stylesheet">

<!-- styles needed by carousel slider -->
<link href="/css/owl.carousel.css" rel="stylesheet">
<link href="/css/owl.theme.css" rel="stylesheet">
<!-- <link href="/css/datepicker.css" rel="stylesheet"> -->
<link href="/js/jquery-ui.theme.min.css" rel='stylesheet'>
<link href="/js/jquery-ui.structure.min.css" rel='stylesheet'>
<link href="/js/jquery-ui.min.css" rel='stylesheet'>

<!-- styles needed by mCustomScrollbar -->
<link href="/css/jquery.mCustomScrollbar.css" rel="stylesheet">

<!-- styles needed by minimalect -->
<link href="/css/jquery.minimalect.min.css" rel="stylesheet">

<link href="/css/rating.css" media="all" rel="stylesheet" type="text/css" />

<link href="/css/custom.css" rel="stylesheet">
<!-- Just for debugging purposes. -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!-- include pace script for automatic web page progress bar  -->

<script>
    paceOptions = {
      elements: true
    };
</script>
<script src="/js/pace.min.js"></script>
<script type="text/javascript" src="/js/jquery/1.8.3/jquery.js"></script> 
<script type="text/javascript">
    var _globalObj = {{ json_encode(array('_token'=> csrf_token())) }}
</script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34418426-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>

<body>
<!-- Fixed navbar start -->
<div class="navbar navbar-tshop navbar-fixed-top megamenu" role="navigation">
  <div class="navbar-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
          <div class="pull-left ">
            <ul class="userMenu topright">
              @if(isset($_COOKIE['ratevendor']))
                <li class='ht20'> 
                  <a href="#"> 
                    <span class="hidden-xs">
                        <div class='txt'>Rate vendor from last order :</div>
                        <input id="input-id" type="number" class="rating" step=0.5 data-size="xs" value="">
                        {{ Form::hidden('vendor_id', $_COOKIE['ratevendor']['vendor_id'],array('class'=>'vid')) }}
                        {{ Form::hidden('user_id', $_COOKIE['ratevendor']['user_id'],array('class'=>'uid')) }}
                        {{ Form::hidden('order_id', $_COOKIE['ratevendor']['ordrid'],array('class'=>'oid')) }} 
                    </span> 
                  </a> 
                </li>
              @else
                <li> <a href="#"> <span class="hidden-xs">Comin soon...</span> </a> </li>
              @endif  
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 no-margin no-padding">
          <div class="pull-right">
            <div id='Date'></div>
            <div id='clock'></div>
            <ul class="userMenu">
             
              @if(Auth::check())
                <li>{{ HTML::link('users/signout','Sign Out') }}</li>
                 <li>{{ HTML::decode(HTML::link('/users/myaccount','<span class="hidden-xs"> My Account</span> <i class="glyphicon glyphicon-user hide visible-xs"></i>')) }}</li>
              @else
                  <li>{{ HTML::decode(HTML::link('#','<span class="hidden-xs">Sign In</span> <i class="glyphicon glyphicon-log-in hide visible-xs"></i>',array('data-target'=>'#Userlogin','data-toggle'=>'modal'))) }}</li>
                  <li>{{ HTML::decode(HTML::link('#','Create Account',array('data-target'=>'#ModalSignup','data-toggle'=>'modal','class'=>'hidden-xs'))) }}</li>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/.navbar-top-->
  
  <div class="container">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only"> Toggle navigation </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> </button>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-cart"> <i class="fa fa-shopping-cart colorWhite"> </i> <span class="cartRespons colorWhite"> Cart  Rs. {{ Cart::total() }}</span> </button>
      <a class="navbar-brand " href="/"> Funfest </a> 
      <!-- <img src="" alt="Funfest"> -->
      
      <!-- this part for mobile -->
      <div class="search-box pull-right hidden-lg hidden-md hidden-sm">
        <div class="input-group">
          <button class="btn btn-nobg getFullSearch" type="button"> <i class="fa fa-search"> </i> </button>
        </div>
        <!-- /input-group --> 
        
      </div>
    </div>
    
    <!-- this part is duplicate from cartMenu  keep it for mobile -->
    <div class="navbar-cart  collapse">
      <div class="cartMenu  col-lg-4 col-xs-12 col-md-4 ">
        <div class="w100 miniCartTable scroll-pane">
          <table>
            <tbody>
            @foreach($cart_values as $cart)
              <tr class="miniCartProduct">
                <td style="20%" class="miniCartProductThumb"><div> <a href="product-details.html"> {{ HTML::image($cart->image) }} </a> </div></td>
                <td style="40%"><div class="miniCartDescription">
                    <h4> <a href='#'>{{ $cart->name }} </a> </h4>
                    <!--<span class="size"> {{ $cart->quantity }} </span>
                    <div class="price"> <span> {{$cart->price}} </span> </div>-->
                  </div></td>
                <td  style="22%" class="miniCartSubtotal"><span> Rs. {{$cart->price}}</span></td>
                <td  style="5%" class="delete">{{ HTML::link('home/removeitem/'.$cart->identifier,'x')}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        
        
        <div class="miniCartFooter  miniCartFooterInMobile text-right">
          <h3 class="text-right subtotal"> Subtotal: Rs. {{Cart::total()}} </h3>
          <a href='/home/cart' class="btn btn-sm btn-danger"> <i class="fa fa-shopping-cart"> </i> VIEW CART </a> 
        </div> 
        
        
      </div>
      
    </div>
    <!--/.navbar-cart-->
    @if(Session::get('notification'))
       @if($vendor)
          <?php $url = "/admin/orders/index?vendor=1";?>
       @endif 
        <a href="{{ $url }}" title="Orders">
          <div class='notification'>
              <span> {{ Session::get('notification') }}</span>
          </div>
        </a>   
    @endif
    <div class='logo'>
        <a href="/">
        <img width="auto" title="Bouquet & cakes to india" src="/img/mainlogo.png">
        </a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        @if(!Auth::check())
          <li>{{ HTML::link('/','Home',array('class'=>'active')) }}</li>
        @endif
        <li class="dropdown megamenu-fullwidth"> 
          <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img class='fwemboss hidden-xs' title="Gift flower anywhere to india" src="/img/fw.png"/> Flowers <b class="caret"> </b> </a>
          <ul class="dropdown-menu">
            <li class="megamenu-content categories">
            @foreach($catnav as $cat)
              
              <?php 
                if($cat['name'] == 'Anniversary'){
                    $src = '/img/aniversary.png';
                }elseif($cat['name'] == 'Valentines'){
                    $src = '/img/vd.png';
                }elseif($cat['name'] == 'I\'m sorry'){
                    $src = '/img/sorry.png';
                }elseif($cat['name'] == 'Get well soon'){
                    $src = '/img/gws.png';
                }elseif($cat['name'] == 'Birthday'){
                    $src = '/img/birthday.jpg';
                }elseif($cat['name'] == 'Love & Romance'){
                    $src = '/img/lar.png';
                }elseif($cat['name'] == 'Congratulations'){
                    $src = '/img/congrats.png';
                }elseif($cat['name'] == 'Hand Bouquet'){
                    $src = '/img/hb.png';
                }elseif($cat['name'] == 'Sympathy'){
                    $src = '/img/sympathy.png';
                }elseif($cat['name'] == 'Thank you'){
                    $src = '/img/tu.png';
                }
              ?>
              <ul class="col-lg-3  col-sm-3 col-md-3  col-xs-4">
                <li> <a class="newProductMenuBlock" href="/home/category/{{ $cat['id'] }}"> <img title="Anniversary, Valentines, Sorry, Get well soon, Birthday, Congratulations, Sympathy, Thank you" class="img-responsive" src="{{$src}}" alt="product"> <span class="ProductMenuCaption"> <i class="fa fa-caret-right"> </i>  {{ $cat['name'] }} </span> </a></li>
              </ul>
            @endforeach  
              <!-- <ul class="col-lg-3  col-sm-3 col-md-3 col-xs-4">
                <li> <a class="newProductMenuBlock" href="/admin/outlets/index"> <img class="img-responsive" src="/img/lily.jpg" alt="product"> <span class="ProductMenuCaption"> <i class="fa fa-caret-right"> </i>  </span> </a> </li>
              </ul>
              <ul class="col-lg-3  col-sm-3 col-md-3 col-xs-4">
                <li> <a class="newProductMenuBlock" href="/admin/addons/index"> <img class="img-responsive" src="/img/orchid.jpg" alt="product"> <span class="ProductMenuCaption"> <i class="fa fa-caret-right"> </i>  </span> </a> </li>
              </ul> -->
            </li>
          </ul>
        </li>
        <li class="dropdown megamenu-fullwidth"> 
          <a data-toggle="dropdown" class="dropdown-toggle" href="#"><img title="Gift cake anywhere in india" class='fwemboss hidden-xs' src="/img/cake.png"/> Cake <b class="caret"> </b> </a> 
          <ul class="dropdown-menu">
            <li class="megamenu-content cake categories">
              <ul class="col-lg-3  col-sm-3 col-md-3  col-xs-4">
                <li> <a title="birthday cakes to india" class="newProductMenuBlock" href="/cake/index?size=one"> <img title="Gift 1kg cake" class="img-responsive" src="/img/cakes/chocolate.jpg" alt="product"> <span class="ProductMenuCaption"> <i class="fa fa-caret-right"> </i>  1 kg </span> </a></li>
              </ul>
               <ul class="col-lg-3  col-sm-3 col-md-3  col-xs-4">
                <li> <a title="cake delivery india" class="newProductMenuBlock" href="/cake/index?size=half"> <img title="Gift 1/2kg cake" class="img-responsive" src="/img/cakes/heart_choco.jpg" alt="product"> <span class="ProductMenuCaption"> <i class="fa fa-caret-right"> </i>  1/2 kg </span> </a></li>
              </ul>
            </li>
          </ul>   
        </li>
        @if(Auth::check())
            <li>{{ HTML::link('users/myaccount','My account') }}</li>  
            @if(!$super && !$vendor)
              <li>{{ HTML::link('home/cart','Cart') }}</li>
            @endif
            @if($vendor)
              <!-- <li class="dropdown megamenu-fullwidth"> 
                <a data-toggle="dropdown" class="dropdown-toggle" href="#"> Manage <b class="caret"> </b> </a>
                <ul class="dropdown-menu">
                  <li class="megamenu-content ">
                    <ul class="col-lg-3  col-sm-3 col-md-3 unstyled noMarginLeft newCollectionUl">
                      <li>{{ HTML::link('admin/products/index','Add Products') }}</li>
                      <li>{{ HTML::link('admin/outlets/index','Add Outlet') }}</li>
                      <li>{{ HTML::link('admin/addons/index','Add Addon') }}</li>
                    </ul>
                    <ul class="col-lg-3  col-sm-3 col-md-3  col-xs-4">
                      <li> <a class="newProductMenuBlock" href="/admin/products/index"> <img class="img-responsive" src="/img/rose.jpg" alt="product"> <span class="ProductMenuCaption"> <i class="fa fa-caret-right"> </i>  </span> </a> </li>
                    </ul>
                    <ul class="col-lg-3  col-sm-3 col-md-3 col-xs-4">
                      <li> <a class="newProductMenuBlock" href="/admin/outlets/index"> <img class="img-responsive" src="/img/lily.jpg" alt="product"> <span class="ProductMenuCaption"> <i class="fa fa-caret-right"> </i>  </span> </a> </li>
                    </ul>
                    <ul class="col-lg-3  col-sm-3 col-md-3 col-xs-4">
                      <li> <a class="newProductMenuBlock" href="/admin/addons/index"> <img class="img-responsive" src="/img/orchid.jpg" alt="product"> <span class="ProductMenuCaption"> <i class="fa fa-caret-right"> </i>  </span> </a> </li>
                    </ul>
                  </li>
                </ul>
              </li> -->
              
            @endif
        @endif
        <!--  -->
        
        <!-- change width of megamenu = use class > megamenu-fullwidth, megamenu-60width, megamenu-40width -->
      </ul>
      <!--- this part will be hidden for mobile version -->
      <div class="nav navbar-nav navbar-right hidden-xs">
        <div class="dropdown  cartMenu "> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-shopping-cart"> </i> <span class="cartRespons"> Cart Rs. {{ Cart::total() }}</span> <b class="caret"> </b> </a>
          <div class="dropdown-menu col-lg-4 col-xs-12 col-md-4 ">
            <div class="w100 miniCartTable scroll-pane">
              <table>
                <tbody>

                  @foreach($cart_values as $cart)
                    <tr class="miniCartProduct">
                      <td style="width:20%"  class="miniCartProductThumb"><div> <a href="#"> {{ HTML::image($cart->image) }} </a> </div></td>
                      <td style="width:40%"><div class="miniCartDescription">
                          <h4> <a href='#'>{{ $cart->name }} </a> </h4>
                          <!--<span class="size"> {{ $cart->quantity }} </span>
                          <div class="price"> <span> {{$cart->price}} </span> </div>-->
                        </div></td>
                      <td  style="width:10%" class="miniCartQuantity"><a>{{ $cart->quantity }} </a></td>
                      <td  style="width:22%" class="miniCartSubtotal"><span>Rs. {{$cart->price}}</span></td>
                      <td  style="width:5%" class="delete">{{ HTML::link('home/removeitem/'.$cart->identifier,'x')}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!--/.miniCartTable-->
            
            <div class="miniCartFooter text-right">
              <h3 class="text-right subtotal"> Subtotal: {{Cart::total()}} </h3>
              <a href='/home/cart' class="btn btn-sm btn-danger"> <i class="fa fa-shopping-cart"> </i> VIEW CART </a> 
              <!-- <a class="btn btn-sm btn-primary"> CHECKOUT </a> -->
            </div>
            <!--/.miniCartFooter--> 
            
          </div>
          <!--/.dropdown-menu--> 
        </div>
        <!--/.cartMenu-->
        <div class="search-box">
          <div class="input-group">
            <button class="btn btn-nobg getFullSearch" type="button"> <i class="fa fa-search"> </i> </button>
          </div>
          <!-- /input-group --> 
          
        </div>
        <!--/.search-box --> 
      </div>
      <!--/.navbar-nav hidden-xs--> 
      @if(Session::get('user_status') != 'vendor')
      <!-- Part for tracking order -->
        <div class="track_order">
          {{ Form::open(array('url'=>'orders/orderdetails','method'=>'post','id'=>'track_order_status','style'=>'width:240px;')) }}
            <div style="margin-bottom: 5px; font-style: italic;"></div>
            <input name='orderid' class="form-control" placeholder="Speak to our florist/Track your order"/>     
            <div class="btn">Go</div>
          {{ Form::close() }}
        </div>
        <!-- Part for tracking order -->
      @endif  
    </div>
    <!--/.nav-collapse --> 
    
  </div>
  <!--/.container -->
  
  <div class="search-full text-right"> <a class="pull-right search-close"> <i class=" fa fa-times-circle"> </i> </a>
    <div class="searchInputBox pull-right">
        {{ Form::open(array('url'=>'home/search','method'=>'get')) }}
        {{ Form::search('keyword',null,'search-input','Search by keyword') }}
        <button class="btn-nobg search-btn" type="submit"> <i class="fa fa-search"> </i> </button>
        {{ Form::close() }}
      <!-- <input type="search"  data-searchurl="search?=" name="q" placeholder="start typing and hit enter to search" class="search-input">
      <button class="btn-nobg search-btn" type="submit"> <i class="fa fa-search"> </i> </button> -->
    </div>
  </div>
  <!--/.search-full--> 
  
</div>
<!-- /.Fixed navbar  -->
<div style="display:none;">
   delivery , florist , flower, cakes, gifts
</div>
<div class="container main-container">
      @if(Session::has('message'))
        <p class='alert alert-info'>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          {{ Session::get('message') }}
        </p>
      @endif

      @yield('content')
      @yield('pagination')
</div>
<div id="footer" class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
          <h3> Support </h3>
          <ul>
            <li class="supportLi">
              <p> Funfest at your service </p>
              <h4> <a href="mailto:care@Funfest.com" class="inline"> <i class="fa fa-envelope-o"> </i> care@Funfest.com </a> </h4>
            </li>
          </ul>
          @if(Session::get('user_status') != 'vendor')
            <!-- Part for tracking order -->
              <div class="track_order">
                {{ Form::open(array('url'=>'orders/orderdetails','method'=>'post','id'=>'track_order_status','style'=>'width:240px;')) }}
                  <div style="margin-bottom: 5px; font-style: italic;"></div>
                  <input name='orderid' class="form-control" placeholder="Speak to our florist/Track your order"/>     
                  <div class="btn">Go</div>
                {{ Form::close() }}
              </div>
              <!-- Part for tracking order -->
            @endif  
          <h3> Send to cities </h3>
          <ul>
            <li> <a title="flower delivery in Ahmedabad" href="/home/sendtocity?sendtocity=Ahmedabad">Send flowers to Ahmedabad</a> </li>
            <li> <a title="flower delivery in Mangalore" href="/home/sendtocity?sendtocity=Mangalore">Send flowers to Mangalore</a> </li>
            <li> <a title="flower delivery in Chandigarh" href="/home/sendtocity?sendtocity=Chandigarh">Send flowers to Chandigarh</a> </li>
            <li> <a title="flower delivery in Chennai" href="/home/sendtocity?sendtocity=Chennai">Send flowers to Chennai</a> </li>
            <li> <a title="flower delivery in Delhi" href="/home/sendtocity?sendtocity=Delhi">Send flowers to Delhi</a> </li>
            <li> <a title="flower delivery in Gurgaon" href="/home/sendtocity?sendtocity=Gurgaon">Send flowers to Gurgaon</a> </li>
            <li> <a title="flower delivery in Noida" href="/home/sendtocity?sendtocity=Noida">Send flowers to Noida</a> </li>
            <li> <a title="flower delivery in Mumbai" href="/home/sendtocity?sendtocity=Mumbai">Send flowers to Mumbai</a> </li>
            <li> <a title="flower delivery in Pune" href="/home/sendtocity?sendtocity=Pune">Send flowers to Pune</a> </li>
            <li> <a title="flower delivery in Hyderabad" href="/home/sendtocity?sendtocity=Hyderabad">Send flowers to Hyderabad</a> </li>
            <li> <a title="flower delivery in Secunderabad" href="/home/sendtocity?sendtocity=Secunderabad">Send flowers to Secunderabad</a> </li>
          </ul>
        </div>
        <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
          <h3>Merchant login</h3>
          <ul>
            <li>{{ HTML::decode(HTML::link('#','<span class="hidden-xs">Sign In</span> <i class="glyphicon glyphicon-log-in hide visible-xs"></i>',array('data-target'=>'#merchantlogin','data-toggle'=>'modal'))) }}
            </li>
          </ul>
          <hr style="margin-bottom:10px;" />
          <h3> Funfest </h3>
          <ul>
            <li> <a href="/home/aboutus"> About Us </a> </li>
            <li> <a href="/home/faq"> Faq </a> </li>
            <li> <a href="/home/corporates"> Corporates </a> </li>
            <li> <a href="/home/join"> Join Our Florist Network </a> </li>
            <!-- <li> <a href="/home/paymentmode"> Payment Modes </a> </li> -->
            <li> <a href="/home/terms"> Terms Of Use </a> </li>
            <li> <a href="/home/becomeanaffiliate"> Become an Affiliate </a> </li>
            <li> <a href="/home/franchise"> Franchising </a> </li>
          </ul>
        </div>
        <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
          <h3> Stay in touch </h3>
          <ul>
            <li>
              <div class="input-append newsLatterBox text-center">
                <input type="text" placeholder="Email " class="full text-center">
                <button type="button" class="btn  bg-gray"> Subscribe <i class="fa fa-long-arrow-right"> </i> </button>
              </div>
            </li>
          </ul>
          <ul class="social">
            <li> <a href="http://facebook.com/Funfest"> <i class=" fa fa-facebook"> &nbsp; </i> </a> </li>
            <li> <a href="http://twitter.com/lilflorist"> <i class="fa fa-twitter"> &nbsp; </i> </a> </li>
            <!-- <li> <a href="http://youtube.com"> <i class="fa fa-pinterest"> &nbsp; </i> </a> </li> -->
          </ul>
        </div>
        <div class="col-lg-4  col-md-4 col-sm-6 col-xs-12 ">
          <h3 class="instahead">Facebook News</h3>
              <div class="facebook_cont smclass">
                <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FFunfest&width=617&colorscheme=light&show_faces=false&show_border=false&stream=true&header=false&height=900" scrolling="yes" style="border:1px solid #CCC; border-top:none; overflow:hidden; width:390px; height:430px; background: white; float:left; " allowtransparency="true" frameborder="0"></iframe>
                <!-- <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fclubwebsite&amp;width=600&amp;height=800&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=false&amp;appId=313784812114242" scrolling="yes" frameborder="0" style="border:none; overflow:hidden; width:600px; height:800px;" allowTransparency="true"></iframe> -->
                </div>
              <!-- SnapWidget -->
               <!-- <iframe src="http://snapwidget.com/in/?u=YWthc2gwODA2fGlufDEyNXwzfDN8fG5vfDV8bm9uZXxvblN0YXJ0fHllc3xubw==&ve=191114" title="Instagram Widget" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="yes" style="border:none; overflow:hidden; width:390px; height:390px"></iframe> -->
        </div>
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
<!-- All modals at page ends -->

<!-- Modal Login start -->
<div class="modal signUpContent fade" id="merchantlogin" tabindex="-1" role="dialog" >
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
        <h3 class="modal-title-site text-center" > Login to Funfest </h3>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url'=>'/users/signin')) }}
        <input type="hidden" name="type" value="merchant">
        <div class="form-group login-username">
          <div >
            {{ Form::text('username','',array('class'=>'form-control input','size'=>'20','placeholder'=>'Enter Username','id'=>"login-user")) }}
          </div>
        </div>
        <div class="form-group login-password">
          <div >
          {{ Form::custompass('password','','form-control input','Password',"login-password") }}
          </div>
        </div>
        <div class="form-group">
          <div >
            <div class="checkbox login-remember">
              <label>
                <input name="rememberme"  value="forever" checked="checked" type="checkbox">
                Remember Me </label>
            </div>
          </div>
        </div>
        <div >
          <div >
            {{ Form::submit('Sign In',array('class'=>'btn btn-block btn-lg btn-primary')) }}
          </div>
        </div>
        <!--userForm--> 
        {{ Form::close() }}
      </div>
      <div class="modal-footer">
        <p class="text-center"> Not here before? <a data-toggle="modal"  data-dismiss="modal" href="#ModalSignup"> Sign Up. </a> <br>
          <a href="#" > Lost your password? </a> </p>
      </div>
    </div>
    <!-- /.modal-content --> 
    
  </div>
  <!-- /.modal-dialog --> 
  
</div>
<!-- /.Modal Login --> 
<!-- Modal Login start -->
<div class="modal signUpContent fade" id="Userlogin" tabindex="-1" role="dialog" >
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
        <h3 class="modal-title-site text-center" > Login to Funfest </h3>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url'=>'/users/signin')) }}
        <input type="hidden" name="type" value="user">
        <div class="form-group login-username">
          <div >
            {{ Form::text('username','',array('class'=>'form-control input','size'=>'20','placeholder'=>'Enter Username','id'=>"login-user")) }}
          </div>
        </div>
        <div class="form-group login-password">
          <div >
          {{ Form::custompass('password','','form-control input','Password',"login-password") }}
          </div>
        </div>
        <div class="form-group">
          <div >
            <div class="checkbox login-remember">
              <label>
                <input name="rememberme"  value="forever" checked="checked" type="checkbox">
                Remember Me </label>
            </div>
          </div>
        </div>
        <div >
          <div >
            {{ Form::submit('Sign In',array('class'=>'btn btn-block btn-lg btn-primary')) }}
          </div>
        </div>
        <!--userForm--> 
        {{ Form::close() }}
      </div>
      <div class="modal-footer">
        <p class="text-center"> Not here before? <a data-toggle="modal"  data-dismiss="modal" href="#ModalSignup"> Sign Up. </a> <br>
          <a href="#" > Lost your password? </a> </p>
      </div>
    </div>
    <!-- /.modal-content --> 
    
  </div>
  <!-- /.modal-dialog --> 
  
</div>
<!-- /.Modal Login --> 

<!-- Modal Signup start -->
<div class="modal signUpContent fade" id="ModalSignup" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
        <h3 class="modal-title-site text-center" > REGISTER </h3>
      </div>
      <div class="modal-body">
        <div class="control-group"> <a class="fb_button btn  btn-block btn-lg " href="#"> SIGNUP WITH FACEBOOK </a> </div>
        <h5 style="padding:10px 0 10px 0;" class="text-center"> OR </h5>
        @if($errors->has())
          <div id='form-errors'>
            <p>Following errors occurred : </p>
            <ul>
              @foreach ($errors->all() as $error) 
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div><!-- end form errors-->
        @endif
        {{ Form::open(array('url'=>'/users/create')) }} 
        <div class="form-group reg-username">
          <div >
            <input name="username"  class="form-control input"  size="20" placeholder="Enter Username" type="text">
          </div>
        </div>
        <div class="form-group reg-email">
          <div >
            <input name="email"  class="form-control input"  size="20" placeholder="Enter Email" type="text">
          </div>
        </div>
        <div class="form-group reg-password">
          <div >
            <input name="password"  class="form-control input"  size="20" placeholder="Password" type="password">
          </div>
        </div>
        <div class="form-group">
          <div >
            <div class="checkbox login-remember">
              <label>
                <input name="rememberme" id="rememberme" value="forever" checked="checked" type="checkbox">
                Remember Me </label>
            </div>
          </div>
        </div>
        <!-- <div class="form-group">
          {{ Form::label('Type') }}
          {{ Form::select('isVendor', array('0'=>'User','1'=>'Vendor')) }}
        </div>  --> 
        <div >
          <div >
            <input name="submit" class="btn  btn-block btn-lg btn-primary" value="REGISTER" type="submit">
          </div>
        </div>
        <!--userForm--> 
        {{ Form::close() }}
      </div>
      <div class="modal-footer">
        <p class="text-center"> Already member? <a data-toggle="modal"  data-dismiss="modal" href="#Userlogin"> Sign in </a> </p>
      </div>
    </div>
    <!-- /.modal-content --> 
    
  </div>
  <!-- /.modal-dialog --> 
  
</div>
<!-- /.ModalSignup End --> 

</body>
<!-- Le javascript
================================================== --> 

<!-- Placed at the end of the document so the pages load faster --> 

<script src="/bootstrap/js/bootstrap.min.js"></script> 
<!-- <script src="/js/datepicker.js"></script>  -->

<script src="/js/rating.js" type="text/javascript"></script>
<!-- include jqueryCycle plugin --> 
<script src="/js/jquery.cycle2.min.js"></script> 

<!-- include easing plugin --> 
<script src="/js/jquery.easing.1.3.js"></script> 

<!-- include  parallax plugin --> 
<script type="text/javascript"  src="/js/jquery.parallax-1.1.js"></script> 

<!-- optionally include helper plugins --> 
<script type="text/javascript"  src="/js/helper-plugins/jquery.mousewheel.min.js"></script> 

<!-- include mCustomScrollbar plugin //Custom Scrollbar  --> 

<script type="text/javascript" src="/js/jquery.mCustomScrollbar.js"></script> 

<!-- include grid.js // for equal Div height  --> 
<script src="/js/grids.js"></script> 

<!-- include carousel slider plugin  --> 
<script src="/js/owl.carousel.min.js"></script> 

<script src="/js/jquery-ui.min.js"></script>
<!-- include sticker plugin  --> 
<script src="/js/jquery.jgrowl.js"></script> 
<script src="/js/sha512.js"></script> 
<script src="/js/cookie.js"></script> 
<script src="/js/bxslider.js"></script> 
<!-- jQuery minimalect // custom select   
<script src="/js/jquery.minimalect.min.js"></script> --> 

<!-- include touchspin.js // touch friendly input spinner component   --> 
<script src="/js/bootstrap.touchspin.js"></script> 

<!-- include custom script for only homepage  --> 
<script src="/js/home.js"></script> 
<!-- include custom script for site  --> 
<script src="/js/script.js"></script>
<script src="/js/custom.js"></script>
</body>
</html>