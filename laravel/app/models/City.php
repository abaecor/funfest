<?php 

class City extends Eloquent {
	protected $table = 'cities';
	protected $fillable = array('name');
	public $timestamps = false;
}	

?>