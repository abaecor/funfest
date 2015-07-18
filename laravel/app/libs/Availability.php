<?php 

class Availability{

	public static function display($availability){
		if($availability == 0){
			echo "Out of stock";
		}else{
			echo "In stock";
		}
	}

	public static function displayClass($availability){
		if($availability == 0){
			echo "outstock";
		}else{
			echo "instock";
		}
	}	
}

class Rating{
	public static function getRate($val){
		echo ($val*20);
	}
}

?>