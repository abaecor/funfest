<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	public function __construct(){
		$this->beforeFilter(function(){
			// if((isset($_GET['access_id']) && $_GET['access_id'] == '5437edf7890') || isset($_COOKIE['access_id'])){
			// 	if(!isset($_COOKIE['access_id'])){
			// 		setcookie('access_id', $_GET['access_id'], time() + (3600));	
			// 	}
				View::share('catnav', Category::all());
				View::share('cart_values',Cart::contents());
				if(Auth::check()){
					View::share('super', 0);
					View::share('vendor', 0);	
					View::share('user', 0);	
					View::share('user_id', Auth::user()->id);
					if(Auth::user()->isSuper){
						View::share('super', 1);	
						Session::put('user_status', 'super');
					}elseif(Auth::user()->isVendor){
						$notification = Order::where('vendor_id','=',Auth::user()->id)->where('notification','=',1)->count();
						View::share('vendor', 1);	
						Session::put('notification',$notification);
						Session::put('user_status', 'vendor');
					}else{
						View::share('user', 1);	
						Session::put('user_status', 'user');
					}
					View::share('guest_user', 0);
				}else{
					View::share('guest_user', 1);
					$notification = 0;
					Session::put('notification',$notification);
					Session::put('user_status', 'guest_user');
					View::share('user_id', uniqid());
				}
			// }else{
			// 	 return Redirect::to('http://www.Funfest.com');
			// }
		});
	}	

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
