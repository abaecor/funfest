<?php

class Outlet extends Eloquent{

	public static $rules = array('address1'=>'required',
								 'address2'=>'required',
								 'city'=>'required',
								 'pincode'=>'required',
								 'delivery_options'=>'required');

}
?>