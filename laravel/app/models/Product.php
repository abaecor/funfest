<?php 

class Product extends Eloquent {

	public static $rules = array(
				'category_id' => 'required',
				'vendor_id' => 'required',
				'title' => 'required|min:4',
				'description' => 'required',
				'regular_price' => 'required|numeric',
				'delux_price' => 'required|numeric',
				'premium_price' => 'required|numeric',
				'image' => 'required'
			);

	public function category(){
		return $this->belongsTo('Category');
	}
	
	public static function get_rat($vid){
		$rating = DB::table('ratings')->where('ratings.ven_id','=',$vid)->avg('rvalue');
		return $rating;
	}

	public static function getproductdesc($id){
		$description = Product::where('id','=',$id)->get(array('description'))->toArray();
		return $description[0]['description'];
	}
}	

?>