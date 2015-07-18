<?php 

class Cakes extends Eloquent{
	protected $table = 'cakes';
	public static function getproductdesc($id){
		$description = Cakes::where('id','=',$id)->get(array('title','description'))->toArray();
		$desc = $description[0]['title']." ".$description[0]['description'];
		return $desc;
	}
}


?>