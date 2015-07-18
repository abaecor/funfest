<?php

class Vendor extends Eloquent{

	protected $guarded = array('id', 'status');

	public static $rules = array(
				'firstname' =>'required',
				'username' => 'required|min:5',
				'password' => 'required|min:6',
				'address' => 'required',
				'primary_phone' => 'required',
			);

}
?>