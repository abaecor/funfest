<?php 

class Prodvenrelations extends Eloquent {

	protected $fillable = array('regular_price', 'vendor_id', 'prod_id','city','delux_price','premium_price');

	public static $rules = array(
				'vendor_id' => 'required',
				'prod_id' => 'required',
				'city' => 'required',
				'regular_price' => 'required',
				'delux_price' => 'required',
				'premium_price' => 'required'
			);

}	

?>