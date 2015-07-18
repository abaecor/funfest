<?php

class OutletsController extends BaseController {

	public function __construct(){
		parent::__construct();
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getIndex(){
		return View::make('outlets.index')
				->with('outlets',Outlet::where('user_id','=',Auth::user()->id)->get());
	}

	public function postAddoutlets(){
		$outlet =  new Outlet;
		$outlet->user_id = Input::get('user_id');
		$outlet->address1 = Input::get('address1');
		$outlet->address2 = Input::get('address2');
		$outlet->city = Input::get('city');
		$outlet->pincode = Input::get('pincode');
		$outlet->phone = Input::get('phone');
		$arr = Input::get('delivery_options');
		$output = "";
		foreach ($arr as $key => $value) {
			$output .= $value.",";
		}
		$output = rtrim($output, ",");
		$outlet->delivery_options = $output;
		$outlet->save();
		return Redirect::to('admin/outlets/index');
	}
}
?>