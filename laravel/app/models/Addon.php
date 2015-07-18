<?php

class Addon extends Eloquent{

	public static $rules = array('type'=>'required',
								 'description'=>'required',
								 'price'=>'required',
								 'image'=>'required',
								 'vendor_id'=>'required');

}
?>