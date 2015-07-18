<?php

class Category extends Eloquent{

	public static $rules = array('name'=>'required|min:3');

	public function products(){
		return $this->hasMany('Product');
	}

}
?>