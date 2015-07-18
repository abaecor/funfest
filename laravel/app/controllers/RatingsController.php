<?php

class RatingsController extends BaseController{

	public function __construct(){
		parent::__construct();
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getIndex(){
		$rating = new Rating;
		$rating = Rating::where('ven_id','=','14')->avg('rvalue');
		echo $rating;
		//return 'Ratings';
	}
}
?>
