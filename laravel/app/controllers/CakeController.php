<?php 

class CakeController extends BaseController{
	
	public function __construct(){
		parent::__construct();
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getIndex(){
		$category_selected = "";
		$tocity = "";
		if(isset($_GET['size'])){
			$category_selected = $_GET['size'];	
			Session::put('category_selected', $category_selected);
		}
		
		if(Session::has('category_selected')){
			$category_selected =  Session::get('category_selected');
		}
		$perPage = 8;
		if(isset($_GET['tocity'])){
			$tocity = $_GET['tocity'];
			Session::put('city', $tocity);
		}

		if(Session::has('city')) {
			$tocity = Session::get('city');
		}
		if(isset($_GET['page'])){
			$currentPage = $_GET['page'] - 1;	
		}else{
			$currentPage = 0;
		}

		if($tocity != ""){
			$cakes = Cakes::where('type','=',$category_selected)->where('city','=',$tocity)->get()->toArray();
		}else{
			$cakes = Cakes::where('type','=',$category_selected)->get()->toArray();
		}

		$tmp = array();

		foreach($cakes as $arg){
			$tmp[$arg['title']][] = $arg;
		}
		$cakes = $tmp;
		$pagedData = array_slice($cakes, $currentPage * $perPage, $perPage);
		$links = Paginator::make($cakes, count($cakes), $perPage);
		return View::make('cake.index')
					->with('category_selected',$category_selected)
					->with('city_list',City::all())
					->with('cakes',$pagedData)
					->with('links',$links)
					->with('tocity',$tocity)
					->with('city_to_go',"");
	}

	public function getBatch(){
		 return View::make('cake.batch');
	}

	public function postBatch(){
		$file = Input::file('excel_file');
		$result = Excel::load($file, function($reader) {
		 		$reader->take(500);
		 })->toArray();
		$data = array_filter($result);
		if(isset($data[0][0]['vendor_id'])){
			$data = $data[0];
		}
		$i = 0;
		foreach ($data as $key=>$value) {
			$cakes = new Cakes;
			$cakes->vendor_id = $value['vendor_id'];
			$cakes->product_code = $value['product_code'];
			$cakes->title = $value['title'];
			$cakes->description = $value['description'];
			$cakes->type = $value['type'];
			$cakes->price = $value['price'];
			$cakes->availability = $value['availability'];
			$cakes->image = $value['image'];
			$cakes->city = $value['city'];
			if($cakes->save()){

			}else{
				$i ++;
			}
		}
		if($i){
			return Redirect::to('/cake/index')
				->with('message','Error in cakes upload.');
		}else{
			return Redirect::to('/cake/index')
				->with('message','Cakes upload succesfull.');
		}
	}
	public function getView($id){
		$cake = Cakes::where('id','=',$id)->get()->toArray();
		return View::make('cake.view')
				   ->with('cake',$cake[0]);
	}

	public function postAddtocart(){
		$cake = Cakes::find(Input::get('id'));
		$quantity = Input::get('quantity');
		$delivery_date = Input::get('delivery_date');
		
		$price = Input::get('price');
		
		Cart::insert(array(
			'id'=>$cake->id,
			'code'=>$cake->product_code,
			'name'=>$cake->title,
			'price'=>$price,
			'quantity'=>$quantity,
			'vendor_id'=>Input::get('vend_id'),
			'type'=>'p',
			'delivery_date'=>$delivery_date,
			'image'=>$cake->image,
		));
		
		return Redirect::to('home/cart')->with('purchase_type','cake');

	}

}

?>