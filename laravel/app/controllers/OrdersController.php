<?php

class OrdersController extends BaseController {

	public function __construct(){
		parent::__construct();
		//$this->beforeFilter('csrf',array('on'=>'post'));
		$this->beforeFilter('auth',array('only'=>array('postAddtocart','getCart','getRemoveitem')));
	}

	public function getIndex(){
		$super = 0;
		$vendor = 0;
		if(isset($_GET['vendor']) && $_GET['vendor']){
			$affected = Order::where('vendor_id','=',Auth::user()->id)->update(array('notification' => 0));
			$vendor = 1;
			$orders = Order::where('vendor_id','=',Auth::user()->id)->get();
			 return View::make('orders.index')
			 	->with('orders',$orders)
			 	->with('super',$super)
			 	->with('vendor',$vendor);
		}else if(isset($_GET['super']) && $_GET['super'] && Auth::user()->isSuper){
			$super = 1;
			$orders = Order::all();
			$ordermasters = Ordermaster::all();
			 return View::make('orders.index')
			 	->with('orders',$orders)
			 	->with('ordermasters',$ordermasters)
			 	->with('super',$super)
			 	->with('vendor',$vendor);
		}else{
			$data_set = DB::table('orders')
				        ->leftJoin('ratings', 'orders.order_id', '=', 'ratings.odr_id')
				        ->where('orders.user_id','=',Auth::user()->id)
				        ->get();
			return View::make('orders.userindex')
			  	->with('orders',$data_set)
			  	->with('super',$super)
			 	->with('vendor',$vendor);
		}
		//return View::make('orders.index');
	}

	public function postSaveorder(){
		setcookie('orderdetails', json_encode($_POST), time() + 60*60*24*30, '/');
		$final_total = "";
		$code = $_POST['coupon'];
		$response = array('success'=>'true');
		if($code != ""){
			$coupon_det = Coupon::where('code','=',$code)->first()->toArray();
			if(strtotime($coupon_det['expiry']) > time() && $coupon_det['status'] == 'activated'){
				if($coupon_det['type'] == 'discount'){
					$final_total = intval($_POST['subtotal']) - ((intval($_POST['subtotal']) * intval($coupon_det['discount']))/100);
				}else{
					$final_total = $_POST['subtotal'] - $coupon_det['discount'];
				}
				if($coupon_det['batchuniqid'] != ""){
					Coupon::where('code','=',$code)->update(array('status' => 'deactivated'));
				}
				$response = array('success'=>'true','message'=>'Coupon code added.','final_total'=>$final_total);
			}else{
				$response = array('success'=>'false','message'=>'Coupon code expired.');
			}
		}
		return json_encode($response);
	}

	public function postOrderdetails(){
		$orders = Order::where('order_id','=',Input::get('orderid'))->get();
		$vendor_det = User::where('id','=',$orders[0]->vendor_id)->get()->toArray();
		$orders_billing = Ordermaster::where('order_id','=',Input::get('orderid'))->get();
		//$product_det = Product::where('id','=',$orders[0]->product_id)->get();
		return View::make('orders/orderdetails')
				->with('vendor_det',$vendor_det)
				->with('orders',$orders)
				->with('orders_billing',$orders_billing)
				->with('disc_code',$orders[0]->disc_code);
	}

	public function postRatings(){
		$response = array('success'=>'false');
		$rating =  new Rating;
		$rating = Rating::firstOrNew(array('usr_id'=>$_POST['uid'],'odr_id'=>$_POST['oid'],'ven_id'=>$_POST['vid']));
		$rating->rvalue = $_POST['rvalue'];
		$rating->usr_id = $_POST['uid'];
		$rating->odr_id = $_POST['oid'];
		$rating->ven_id = $_POST['vid'];
		if($rating->save()){
			$response = array('success'=>'true');
			if(isset($_COOKIE['ratevendor']['vendor_id'])){
				setcookie('ratevendor[vendor_id]',"",time()-10,'/');
				setcookie('ratevendor[user_id]',"",time()-10,'/');
				setcookie('ratevendor[ordrid]',"",time()-10,'/');
			}
		}else{
			$response = array('success'=>'false');
		}
		return json_encode($response);
	}

	public function postUpdatestatus(){

		if(Order::where('order_id','=',$_POST['ordrid'])->update(array('status' => $_POST['status']))){
			$msg = $_POST['status'] == 'neworder' ? 'initiated' : $_POST['status'];
			$username = "thevikin";
			$password = "185473";
			$url = "http://smslane.com/vendorsms/pushsms.aspx?user=".$username."&password=".$password."&msisdn=91".$_POST['phone'].
				   "&sid=WebSms&msg=Your order has been ".$msg."&fl=1";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$resp = curl_exec($ch);
			$vendor_id = Order::where('order_id','=',$_POST['ordrid'])->get(array('vendor_id'))->toArray();
			$vendor_email = User::getemail($vendor_id[0]['vendor_id']);

			Mail::send('emails.orderstatus', array('msg'=>$msg), function($message) use ($vendor_email){
				$message->from('care@littleflorist.com', 'Littleflorist');
				$message->subject('RE: Order status updated');
				$message->to($vendor_email);
			});

			$response = array('success'=>true);
		}else{
			$response = array('success'=>false);
		}
		return json_encode($response);
	}

	public function getView($order_id){
		$order = Order::where('order_id','=',$order_id)->get()->toArray();
//		$order_master = Ordermaster::where('order_id','=',$order_id)->get()->toArray();
		if($order[0]['type'] == "cake"){
			$prod_details = Cakes::where('id','=',$order[0]['product_id'])->get(array('image','title','description'))->toArray();
		}else{
			$prod_details = Product::where('id','=',$order[0]['product_id'])->get(array('image','title','description'))->toArray();
		}

		$order_addon_id = $order[0]['add_on_id'];
		$addon_det = array();
		if($order_addon_id != ""){
			$order_addons = explode(',',$order_addon_id);
			foreach($order_addons as $k => $v){
				$temp = Addon::find($v)->toArray();
				array_push($addon_det,$temp);
			}
		}
		$order[0]['prod_details'] = $prod_details[0];
//		$order[0]['master_details'] = $order_master[0];
		return View::make('orders.view')
				->with('order',$order[0])
				->with('addon_det',$addon_det);
	}

	public function postUpdateclearance(){

		if(Order::where('order_id','=',$_POST['ordrid'])->update(array('payment_clearance' => $_POST['status']))){
			$msg = $_POST['status'] == 'cleared' ? 'cleared' : $_POST['status'];
			$username = "thevikin";
			$password = "185473";
			$url = "http://smslane.com/vendorsms/pushsms.aspx?user=".$username."&password=".$password."&msisdn=91".$_POST['phone'].
				"&sid=WebSms&msg=Your order has been updated and payment is ".$msg.".Please refer the website for details.&fl=1";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_exec($ch);

			$response = array('success'=>true);
		}else{
			$response = array('success'=>false);
		}

		return json_encode($response);
	}
}
