<?php

class HomeController extends BaseController {

	public function __construct(){
		parent::__construct();
		//$this->beforeFilter('csrf',array('on'=>'post'));
		//$this->beforeFilter('auth',array('only'=>array('postAddtocart','getCart','getRemoveitem')));
	}


	public function getIndex()
	{
		return View::make('home.index')
			->with('products',Product::where('category_id','!=','15')->where('title','!=','Exotica')->orderBy('regular_price', 'ASC')->paginate(8))
			->with('city_list',City::all());
	}

	public function postPaymentfailed()
	{
		$det = Cart::contents();
		$vendor_id = '';
		foreach($det as $item){
			$vendor_id = $item->vendor_id;
		}
		$addon_items = '';
		if($vendor_id != ''){
			$addon_items = Addon::where('vendor_id','=',$vendor_id)->get();
		}
		Session::flash('message', 'Sorry, the transaction failed due to some internal erros. Please try again.'); 
		$products = Cart::contents();
		Mail::send('emails.orderfailed', array('products'=>$products), function($message){
		    $message->from('care@Funfest.com', 'Funfest');
		    $message->to($_POST['email']);
		    $message->subject('RE: Order Failed, Funfest');
		});

		$username = "thevikin";
		$password = "185473";
		$url = "http://smslane.com/vendorsms/pushsms.aspx?user=".$username."&password=".$password."&msisdn=91".$_POST['phone'].
			   "&sid=WebSms&msg=Your order has failed. Please try again later.&fl=1";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);

		return View::make('home.cart')
				->with('products',Cart::contents())
				->with('txnid',$_POST['txnid'])
				->with('addon_items',$addon_items)
				->with('city_list',City::all());
	}

	public function postPaymentsuccess(){
		$order_info = (array) json_decode($_COOKIE['orderdetails']);
		$order_id =  $order_info['txnid'];
		$product_id = implode(',', $order_info['product_id']);
		$product_quantity = implode(',', $order_info['product_quantity']);
		$product_vendor_id = implode(',', $order_info['product_vendor_id']);
		$shipping_det = (array) $order_info['shipping'];
		$billing_det = (array) $order_info['billing'];
		if(isset($order_info['addon_vendor_id'])){
			$add_on_id = implode(',', $order_info['addon_id']);
		}
		// Saving to order table
		$order =  new Order;
		$order->order_id = $order_id;
		$order->user_id = $order_info['user_id'];
		$order->product_id = $product_id;
		if(isset($add_on_id)){
			$order->add_on_id = $add_on_id;	
		}
		$order->vendor_id = ($order_info['udf2'] == 'cake') ? User::cakegetid($product_vendor_id) : $product_vendor_id;

		$order->name = $shipping_det['first_name']." ".$shipping_det['last_name'];
		$order->contact = $shipping_det['mobile'];
		$order->shipping_address = $shipping_det['address']." ".$shipping_det['address2'];
		$order->shipping_city = $shipping_det['scity'];
		$order->shipping_zip = $shipping_det['zip_code'];
		$order->shipping_state = $shipping_det['state'];
		$order->price = $order_info['subtotal'];
		$order->disc_code = $order_info['coupon'];
		$order->status = 'neworder';
		$order->type = $order_info['udf2'];
		$order->user_message = $order_info['personalmessage'];
		$order->delivery_date = $order_info['delivery_date'];
		$order->payment_clearance = 'uncleared';
		$order->quantity = $product_quantity;
			
		// Saving to order master table
		$ordermaster =  new Ordermaster;
		$ordermaster->order_id = $order_id;
		$ordermaster->transaction_id = 0;
		$ordermaster->payment_method = 'others';
		$ordermaster->name = $shipping_det['first_name']." ".$shipping_det['last_name'];
		$ordermaster->contact = $shipping_det['mobile'];
		$ordermaster->billing_address = $billing_det['address']." ".$billing_det['address2'];
		$ordermaster->billing_city = $billing_det['bcity'];
		$ordermaster->billing_zip = $billing_det['zip_code'];
		$ordermaster->billing_state = $billing_det['state'];
		$ordermaster->bill_value = $order_info['subtotal'];
		$ordermaster->status = 'uncleared';
		$ordermaster->email = $billing_det['email'];
		$ordermaster->process = 'new';
		//  Saving order details
		if($order->save() && $ordermaster->save()){
			// Set for Rating 
			$det = Cart::contents();
			
			$vendor_id = ($order_info['udf2'] == 'cake') ? User::cakegetid($product_vendor_id) : $product_vendor_id;
			if(Auth::check()){
				$user_id = Auth::user()->id;	
			}else{
				$user_id = uniqid();	
			}
			
			$ordrid = $order_info['txnid'];
			
			foreach($det as $item){
				$vendor_id = $item->vendor_id;
			}
			if($vendor_id != ""){
				setcookie( "ratevendor[vendor_id]", $vendor_id, time()+ 60*60*24*30, '/' );	
				setcookie( "ratevendor[user_id]", $user_id, time()+ 60*60*24*30, '/' );	
				setcookie( "ratevendor[ordrid]", $ordrid, time()+ 60*60*24*30, '/' );	
			}
			// Set for Rating 
			$products = Cart::contents();
			$total = Cart::total();
			Cart::destroy();
			$billing_det = (array) $order_info['billing'];
			
			// Notify user for successfull payment
			Mail::send('emails.orderconfirm', array('details_for_order'=>$order_info,'products'=>$products,'total' => $total), function($message) use ($order_info,$billing_det){
			    $message->from('care@Funfest.com', 'Funfest');
			    $message->subject('RE: Order successful, Funfest order no. '.$order_info['txnid']);
			    $message->to($billing_det['email']);
			});

			$vendor_email = User::getemail($vendor_id);
			$vendor_email = "techwarrior@Funfest.com";
			if($vendor_email != ""){
				Mail::send('emails.vendornotify', array('details_for_order'=>$order_info,'products'=>$products,'total' => $total), function($message) use ($order_info,$billing_det,$vendor_email){
					$message->from('care@Funfest.com', 'Funfest');
					$message->subject('RE: Order successful, Funfest order no. '.$order_info['txnid']);
					$message->to( $vendor_email );//->cc('care@Funfest.com');
				});
			} else {
				Mail::send('emails.vendornotify', array('details_for_order'=>$order_info,'products'=>$products,'total' => $total), function($message) use ($billing_det){
					$message->from('care@Funfest.com', 'Funfest');
					$message->subject('RE: Order for cake (vendor email was null).');
					$message->to('care@Funfest.com');
				});
			}


			// Send messgae to user
			$username = "thevikin";
			$password = "185473";
			$url = "http://smslane.com/vendorsms/pushsms.aspx?user=".$username."&password=".$password."&msisdn=91".$order_info['phone'].
				   "&sid=WebSms&msg=Your order has been placed successfully. Your order id is ".$order_info['txnid']."&fl=1";

			$ch =  curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);

			// Send messgae to vendor
			$vendor_rmn = User::getrmn($product_vendor_id);
			if($vendor_rmn != ""){
				$username = "thevikin";
				$password = "185473";
				$url = "http://smslane.com/vendorsms/pushsms.aspx?user=".$username."&password=".$password."&msisdn=91".$vendor_rmn.
					   "&sid=WebSms&msg=You received a new order, order id ".$order_info['txnid'].". Please login to the website to get the details.&fl=1";

				$ch =  curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($ch);
			}
			
			Ordermaster::where('order_id','=',$_POST['txnid'])->update(
																		array('transaction_id' => $_POST['mihpayid'],
																			  'bank_transaction_id' => $_POST['bank_ref_num'],
																			  'status' => 'cleared',
																			  'process' => 'initiate'));
			Order::where('order_id','=',$_POST['txnid'])->update(array('status' => 'neworder','process'=>'initiate','payment_clearance'=>'cleared'));

			return View::make('/home/thankyou')
						->with('purchase_data',$_POST)
						->with('message', "The transaction was successful, your order is on it's way.");	
			
		}
	}

	public function postPaymentcancel()
	{
		$det = Cart::contents();
		$vendor_id = '';
		foreach($det as $item){
			$vendor_id = $item->vendor_id;
		}
		$addon_items = '';
		if($vendor_id != ''){
			$addon_items = Addon::where('vendor_id','=',$vendor_id)->get();
		}
		Session::flash('message', 'The transaction has been cancelled successfully.'); 
		$products = Cart::contents();
		$details_for_order = $_POST;
		Mail::send('emails.ordercancel', array('products'=>$products,'details_for_order'=>$details_for_order), function($message){
		    $message->from('care@Funfest.com', 'Funfest');
		    $message->to($_POST['email']);
		    $message->subject('RE: Order Cancellation, Funfest');
		});

		$username = "thevikin";
		$password = "185473";
		$url = "http://smslane.com/vendorsms/pushsms.aspx?user=".$username."&password=".$password."&msisdn=91".$_POST['phone'].
			   "&sid=WebSms&msg=Your order has been cancelled. Avail exciting prices and discount on numerous products at Funfest.&fl=1";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_exec($ch);

		return View::make('home.cart')
				->with('products',$products)
				->with('addon_items',$addon_items)
				->with('details_for_order',$details_for_order)
				->with('txnid',$_POST['txnid'])
				->with('city_list',City::all())
				->with('message','Sorry, the transaction has been cancelled.');
	}

	public function getView($id)
	{
		if(isset($_GET['tocity']) && $_GET['tocity'] !=""){

			$product = Product::where('id','=',$id)->first()->toArray();
			$fetch_prod = Prodvenrelations::where('product_id','=',$id)
										  ->where('city','like',"%".$_GET['tocity']."%")->get()->toArray();
			$other_ven = array();
			if(count($fetch_prod) > 1){
				foreach($fetch_prod as  $k => $v){
					$other_ven[$k] = (object)$v;
				}	
			}
			$nodata = 1;
			if(!empty($fetch_prod)){
				$product['vendor_id'] = $fetch_prod[0]['vendor_id'];
				$product['regular_price'] = $fetch_prod[0]['regular_price'];
				$product['delux_price'] = $fetch_prod[0]['delux_price'];
				$product['premium_price'] = $fetch_prod[0]['premium_price'];
				$product['description'] = $fetch_prod[0]['description'];
			}else{
				$product = (array)$product;
				if($product['city'] == $_GET['tocity']){
					$nodata = 1;	
				}else{
					$nodata = 0;
				}
			}
			$product = (object)$product;
			$addon_items = Addon::all();
			return View::make('home.view')
					->with('product',$product)
					->with('other_ven',$other_ven)
					->with('addon_items',$addon_items)
					->with('nodata',$nodata);

		}else{
			$nodata = 1;
			$product = Product::find($id);	
			$vendor_id = $product->vendor_id;
			$vendor_items = Product::where('vendor_id','=',$vendor_id)->get();
			$addon_items = Addon::all();
			$other_ven = array();
			if(trim($product->ovid) != ""){
				$ovid_val = ltrim($product->ovid,',');
				$arr = explode(',', $ovid_val);
				foreach ($arr as $key => $value) {
					$other_ven[] = Prodvenrelations::find($value); 
				}
			}
			return View::make('home.view')
					->with('product',$product)
					->with('vendor_items',$vendor_items)
					->with('other_ven',$other_ven)
					->with('addon_items',$addon_items)
						->with('nodata',$nodata)
					->with('city_list',City::all());
		}
	}

	public function getCategory($cat_id){
		$rmax = "";
		$rmin = "";
		$city = "";
		$category_selected =  Category::find($cat_id);
		$city_sel = false;
		$tag_to_search = "";

		if($cat_id == 4){
			$tag_to_search = "aniversary";
		}elseif($cat_id == 5){
			$tag_to_search = "valentines";
		}elseif($cat_id == 6){
			$tag_to_search = "sorry";
		}elseif($cat_id == 7){
			$tag_to_search = "gws";
		}elseif($cat_id == 9){
			$tag_to_search = "birthday";
		}elseif($cat_id == 10){
			$tag_to_search = "loveromance";
		}elseif($cat_id == 11){
			$tag_to_search = "congrats";
		}elseif($cat_id == 12){
			$tag_to_search = "handbouquet";
		}elseif($cat_id == 13){
			$tag_to_search = "sympathy";
		}elseif($cat_id == 14){
			$tag_to_search = "thankyou";
		}
		if(!isset($_GET['city'])){
			if(Session::has('city')){
				$city = Session::get('city');
			}else{
				Session::flash('message', 'Please select a city first');
				$city_sel = true;	
			}
		}else{
			$city = $_GET['city'];
			Session::put('city', $city);
		}
		$perPage = 8;

		if(isset($_GET['page'])){
			$currentPage = $_GET['page'] - 1;	
		}else{
			$currentPage = 0;
		}
		$products1 = Product::where('tags','like','%'.$tag_to_search.'%')->where('title','!=','Exotica')->get()->toArray();
		$products2 = array();
		if($city != 'Ahmedabad' && $city != ""){
			foreach($products1 as $key => $value) {
				$temp = Prodvenrelations::where('product_id','=',$value['id'])->where('city','like','%'.$city.'%')->get()->toArray();
				if(!empty($temp)){
					$products2[$key] = $temp[0];
					$products2[$key]['image'] = $value['image'];
					$products2[$key]['title'] = $value['title'];
					$products2[$key]['id'] = $value['id'];
				}
			}
			$products1 = array();
		}
		
		$products = array_merge($products1,$products2);
		$nodata = 1;
		if(empty($products)){
			$nodata = 0;
		}
		$pagedData = array_slice($products, $currentPage * $perPage, $perPage);
		$links = Paginator::make($products, count($products), $perPage);
		
	 	return View::make('home.category')
			->with('products', $pagedData)
			->with('city_to_go',$city)
			->with('city',$city_sel)
			->with('category_selected',$category_selected)
			->with('rmin',$rmin)
			->with('rmax',$rmax)
			->with('links',$links)
			->with('nodata',$nodata)
			->with('city_list',City::all());
	}

	public function getSearch(){
		$keyword = Input::get('keyword');
		return View::make('home.search')
			->with('products',Product::where('title','LIKE','%'.$keyword.'%')->paginate(8))
			->with('keyword',$keyword);
	}
	public function postAddtocart(){
		$product = Product::find(Input::get('id'));
		$quantity = Input::get('quantity');
		$delivery_date = Input::get('delivery_date');
		
		$price = '';
		if(isset($_GET['reg'])){
			$price = Input::get('reg_price');
		}else if(isset($_GET['dlx'])){
			$price = Input::get('dlx_price');
		}else if(isset($_GET['pri'])){
			$price = Input::get('prm_price');
		}

		Cart::insert(array(
			'id'=>$product->id,
			'code'=>$product->product_code,
			'name'=>$product->title,
			'price'=>$price,
			'quantity'=>$quantity,
			'vendor_id'=>Input::get('vend_id'),
			'type'=>'p',
			'delivery_date'=>$delivery_date,
			'image'=>$product->image,
		));
		
		$addons = Input::get('aid');
		if(!empty($addons)){
			foreach ($addons as $key => $value) {
				$addon = Addon::find($value);
				Cart::insert(array(
					'id'=>$addon->id,
					'name'=>$addon->description,
					'price'=>$addon->price,
					'quantity'=>$quantity,
					'vendor_id'=>$addon->vendor_id,
					'delivery_date'=>$delivery_date,
					'type'=>'a',
					'image'=>$addon->image,
				));
			}	
		}
		return Redirect::to('home/cart')->with('purchase_type','flower');

	}

		
	public function getCart(){
		$vendor_id = '';
		if(count(Cart::contents()) != 0){
			$det = Cart::contents();
			foreach($det as $item){
				$vendor_id = $item->vendor_id;
			}
		}
		$addon_items = '';
		if($vendor_id != ''){
			$addon_items = Addon::where('vendor_id','=',$vendor_id)->get();
		}
		return View::make('home.cart')
				->with('products',Cart::contents())
				->with('addon_items',$addon_items)
				->with('city_list',City::all());
	}

	public function getRemoveitem($id){
		$item = Cart::item($id);
		$item->remove();
		return Redirect::to('home/cart');
	}

	public function getSendtocity(){
		$city = "";
		$sendtype = "";
		
		//Set type session
		if(Input::has('sendtype')){
			$sendtype = Input::get('sendtype');
			Session::put('sendtype',$sendtype);
		}
		if(Session::has('sendtype')){
			$sendtype = Session::get('sendtype');
		}
			
		//Set flowers session
		if(Input::has('sendtocity')){
			$city = Input::get('sendtocity');
			Session::put('city', $city);
		}

		if(Session::has('city')){
			$city = Session::get('city');
		}

		// Pagination calulation 
		$perPage = 8;

		if(isset($_GET['page'])){
			$currentPage = $_GET['page'] - 1;	
		}else{
			$currentPage = 0;
		}
		if($sendtype == 'flower'){
			$products1 = Product::where('city','like','%'.$city.'%')->get()->toArray();
			$products2 = Prodvenrelations::where('city','like','%'.$city.'%')->get()->toArray();
			if(!empty($products2)){
				foreach ($products2 as $key => $value) {
					$parent_prod = Product::find($value['product_id'])->toArray();
					$products2[$key]['id'] = $parent_prod['id'];
					$products2[$key]['image'] = $parent_prod['image'];
					$products2[$key]['title'] = $parent_prod['title'];
				}	
			}
			
			$products = array_merge($products1,$products2);
			$pagedData = array_slice($products, $currentPage * $perPage, $perPage);
			$links = Paginator::make($products, count($products), $perPage);

			 return View::make('home.sendtocity')
					->with('products', $pagedData)
					->with('city_to_go',$city)
					->with('links',$links)
					->with('city_list',City::all());
		}else{
			$category_selected = "all";
			$cakes = Cakes::where('city','=',$city)->get()->toArray();
			$tmp = array();

			foreach($cakes as $arg){
				$tmp[$arg['title']][] = $arg;
			}
			$cakes = $tmp;
			$pagedData = array_slice($cakes, $currentPage * $perPage, $perPage);
			$links = Paginator::make($cakes, count($cakes), $perPage);
			return View::make('cake.index')
						->with('category_selected',$category_selected)
						->with('city_list',City::all())
						->with('cakes',$pagedData)
						->with('links',$links)
						->with('city_to_go',$city)
						->with('tocity',$city);
		}
	}

	public function postFilterprice(){
		$cat_id = Input::get('cat_id');
		$price_point = Input::get('price');
		$range  = 0;
		$rmax = "";
		$rmin = "";

		if($price_point == 0){
			$min_price = 0;
			$max_price = 500;
		}elseif($price_point < 6){
			$min_price = $price_point * 500;
			$max_price = $min_price + 500;
		}elseif($price_point == 6){
			$min_price = 0;
			$max_price = 3000;
		}

		if(Input::get('from_price') != ""){
			$min_price = Input::get('from_price');
			$max_price = Input::get('to_price');
			$rmax = $max_price;
			$rmin = $min_price;
		}
		
		return View::make('home.category')
			->with('products',Product::where('category_id','=',$cat_id)->where('regular_price','>',$min_price)->where('regular_price','<=',$max_price)->paginate(6))
			->with('category_selected',Category::find($cat_id))
			->with('price_set',$price_point)
			->with('range',$range)
			->with('rmin',$rmin)
			->with('rmax',$rmax);
	}

	public function getCake()
	{
		return View::make('home.cake')
			->with('products',Product::where('category_id','=','15')->orderBy('created_at', 'DESC')->paginate(8))
			->with('city_list',City::all());
	}

	public function getAboutus(){
		 return View::make('home.aboutus');
	}
	public function getFaq(){
		return View::make('home.faq');
	}
	public function getCorporates(){
		return View::make('home.corporates');
	}
	public function getJoin(){
		return View::make('home.join');
	}
	public function getFranchise(){
		return View::make('home.franchise');
	}
	public function getThankyou(){
		return View::make('home.thankyou');
	}
	public function getPaymentmode(){
		return View::make('home.paymentmode');
	}
	public function getTerms(){
		return View::make('home.terms');
	}
	public function getBecomeanaffiliate(){
		return View::make('home.becomeanaffiliate');
	}

	public function postUpdaterates(){
		$rate = Input::get('rate');
		$user = User::find(Auth::user()->id);
		$old_rate = intval($user->rate_upraised);
		$allprice = Product::all(array('id','regular_price','delux_price','premium_price'));
		foreach ($allprice as $key => $value) {
			$reg = $value->regular_price;
			$delux = $value->delux_price;
			$prem = $value->premium_price;
			
			// Fetch old values
			$org_reg = ($reg * 100) / ($old_rate+100);
			$org_delux = ($delux * 100) / ($old_rate+100);
			$org_prem = ($prem * 100) / ($old_rate+100);

			// Apply new values
			$new_reg = $org_reg + (($org_reg * $rate) / 100);
			$new_delux = $org_delux + (($org_delux * $rate) / 100);
			$new_prem = $org_prem + (($org_prem * $rate) / 100);

			$priceup = Product::find($value->id);
			$priceup->regular_price = $new_reg;
			$priceup->delux_price	= $new_delux;
			$priceup->premium_price = $new_prem;
			$priceup->save();
		}
		$user->rate_upraised = $rate;
		$user->save();

		return Redirect::to('/users/myaccount');
	}
}
/*
Array
(
    [mihpayid] => 403993715510524484
    [mode] => CC
    [status] => success
    [unmappedstatus] => captured
    [key] => C0Dr8m
    [txnid] => 547c98867ea08
    [amount] => 2.00
    [discount] => 0.00
    [net_amount_debit] => 2
    [addedon] => 2014-12-01 21:52:29
    [productinfo] => test product
    [firstname] => akash
    [lastname] => 
    [address1] => add 1
    [address2] => add 2
    [city] => Vadodara
    [state] => Gujarat
    [country] => 
    [zipcode] => 
    [email] => techwarrior@Funfest.com
    [phone] => 9033556241
    [udf1] => 25
    [udf2] => 
    [udf3] => 
    [udf4] => 
    [udf5] => 
    [udf6] => 
    [udf7] => 
    [udf8] => 
    [udf9] => 
    [udf10] => 
    [hash] => c515e0c875675aa4cd42d2e836d6fad05941070d8572be84c15e6494b2c911bbbc219fe1b355beb84e5a929344591a82dc96f38561a9a878fd5bd0e3e230e35f
    [field1] => 433558230760
    [field2] => 999999
    [field3] => 4489621532143351
    [field4] => -1
    [field5] => 
    [field6] => 
    [field7] => 
    [field8] => 
    [field9] => SUCCESS
    [payment_source] => payu
    [PG_TYPE] => HDFCPG
    [bank_ref_num] => 4489621532143351
    [bankcode] => CC
    [error] => E000
    [error_Message] => No Error
    [name_on_card] => akash
    [cardnum] => 512345XXXXXX2346
    [cardhash] => This field is no longer supported in postback params.
)

*/