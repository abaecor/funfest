<?php 

class Rating extends Eloquent {

	protected $fillable = array('user_id', 'vendor_id', 'order_id');

	public static $rules = array(
				'user_id' => 'required',
				'vendor_id' => 'required',
				'order_id' => 'required',
				'rvalue' => 'required'
			);

}	

?>