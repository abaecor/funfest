<?php

class ProductsController extends BaseController{

	public function __construct(){
		parent::__construct();
		// $this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getIndex(){
		$categories = array();

		foreach (Category::all() as $category) {
			$categories[$category->id] = $category->name;
		}
		return View::make('products.index')
				->with('products',Product::take(6)->paginate(6))
				->with('categories',$categories);
	}

	public function postCreate(){
		if(Input::get('exists')){
			$validator = Validator::make(Input::all(),Prodvenrelations::$rules);
			if($validator->passes()){
				$prodvenrel = new Prodvenrelations;
				$prodvenrel->vendor_id = Input::get('vendor_id');
				$prodvenrel->product_id = Input::get('prod_id');
				$prodvenrel->description = Input::get('description');
				$prodvenrel->regular_price = Input::get('regular_price');
				$prodvenrel->delux_price = Input::get('delux_price');
				$prodvenrel->premium_price = Input::get('premium_price');
				$prodvenrel->city = Input::get('city');
				$prodvenrel->save();
				$product = Product::where('id','=',Input::get('prod_id'))->first();
				$product->ovid = $product->ovid.",".$prodvenrel->id;
				$product->save();
				return Redirect::to('admin/products/index')
					->with('message','Product created.');
			}	
		}else{
			$validator = Validator::make(Input::all(),Product::$rules);	
			if($validator->passes()){
				$product =  new Product;
				$product->category_id = Input::get('category_id');
				$product->vendor_id = Input::get('vendor_id');
				$product->title = Input::get('title');
				$product->regular_price = Input::get('regular_price');
				$product->delux_price = Input::get('delux_price');
				$product->premium_price = Input::get('premium_price');
				$product->description = Input::get('description');

				$image = Input::file('image');
				
				$filename = date('Y-m-d-H:i:s')."-".$image->getClientOriginalName();

				$path = public_path('img/products/' . $filename);
				
				Image::make($image->getRealPath())->save($path);
				
				$product->image = 'img/products/'.$filename;
				
				$product->save();

				return Redirect::to('admin/products/index')
					->with('message','Product created.');
			}
		}
		return Redirect::to('admin/products/index')
				->with('message','Product not created. Something went wrong.')
				->withErrors($validator)
				->withInput();		
	}

	public function postBatchup(){
		$file = Input::file('excel_file');
		$result = Excel::load($file, function($reader) {
		 		$reader->take(500);
		 })->toArray();
		$data = array_filter($result);
		if(isset($data[0][0]['vendor_id'])){
			$data = $data[0];
		}
		foreach ($data as $key=>$value) {
			//$validator = Validator::make($value,Product::$rules);
			//if($validator->passes()){
			$venid = User::where('uniq_ven_id','=',$value['vendor_id'])->get(array('id'));
			$already_product = Product::where('title','=',$value['title'])->get();
			if($already_product->count()){
				$prodvenrel = new Prodvenrelations;
				$prodvenrel->vendor_id = $venid[0]->id;
				$prodvenrel->product_id = $already_product[0]->id;
				$prodvenrel->description = $value['description'];
				$prodvenrel->regular_price = $value['regular_price'];
				$prodvenrel->delux_price = $value['delux_price'];
				$prodvenrel->premium_price = $value['premium_price'];
				$prodvenrel->city = $value['city'];
				$prodvenrel->save();
				$product = Product::where('id','=',$already_product[0]->id)->first();
				$product->ovid = $product->ovid.",".$prodvenrel->id;
				$product->save();
			}else{
				$product =  new Product;
				$product->category_id = $value['category_id'];
				$product->vendor_id = $venid[0]->id;
				$product->title = $value['title'];
				$product->description = $value['description'];
				//images in another batch up
				//just save the file paths
				$product->image = $value['image'];
				$product->regular_price = $value['regular_price'];
				$product->delux_price = $value['delux_price'];
				$product->premium_price = $value['premium_price'];
				$product->product_code = $value['product_code'];
				$product->city = $value['city'];
				$product->save();
			}
			//}
		}
		return Redirect::to('admin/products/index')
				->with('message','Product created.');
	}

	public function postImagebatchup(){
		$a = Input::all();
		$imgs = Input::get('imgs');
		foreach ($a['imgs'] as $key => $value) {
	 		$filename = $value->getClientOriginalName();
	 		$path = public_path('img/products/' . $filename);
			Image::make($value->getRealPath())->save($path);
	 	}
	 	return Redirect::to('admin/products/index')
					->with('message','Image added sucessfully.');
	}

	public function postDestroy($id=null){
		if($d == null){
			$product = Product::find(Input::get('id'));	
		}else{
			$product = Product::find($id);
		}
		

		if($product){
			File::delete('public/'.$product->image);
			$product->delete();

			return Redirect::to('admin/products/index')
					->with('message','Product deleted');
		}
			return Redirect::to('admin/products/index')
					->with('message','Something went wrong.')
					->withErrors($validator)
					->withInput();
	}

	public function postToggleAvailability(){
		$product = Product::find(Input::get('id'));
		if($product){
			$product->availability = Input::get('availability');
			$product->save();
			return Redirect::to('admin/products/index')->with('message','Product Updated.');
		}
		return Redirect::to('admin/products/index')->with('message','Product invalid.');
	}

	public function postFetchtitle(){
		$title = $_POST['title'];
		$product = Product::where('title','=',$title)->get();
		if($product->count()){
			return json_encode($product);
		}
		return 0;
	}

	public function postFetchotherven(){
		$id = $_POST['prod_id'];
		$product = Product::find($id);
		$ovid = $product->ovid;
		$arr = explode(',', $ovid);
		unset($arr[0]);
		$str = "<table>";
		$str = "<tr><th>Florist</th><th>Price</th></tr>";
		foreach ($arr as $key => $value) {
			$pvrln = Prodvenrelations::find($value);
			$ven_name = User::fetch_name($pvrln->vendor_id);
			$str .=	"<tr>";
				$str .=	"<td>".$ven_name."</td>";
				$str .=	"<td>".$pvrln->regular_price."</td>";
			$str .=	"</tr>";	
		}
		$str .= "</table>";

		return $str;
	}

	public function getViewall($id=null){
		if($id == null){
			$products = Product::where('category_id','!=','15')->orderBy('created_at', 'DESC')->paginate(10);
		}else{
			$products = Product::where('vendor_id','=',$id)->where('category_id','!=','15')->orderBy('created_at', 'DESC')->paginate(10);
		}
		return View::make('products.viewall')
				->with('products',$products);
	}

	public function getEdit($id=null){
		if($id != null){
			$products = Product::find($id);
		}
		return View::make('products.edit')
				->with('products',$products);
	}

	public function postEdit(){
		if(Session::get('user_status') == 'super'){
			$product = Product::find(Input::get('id'));
			$product->title = Input::get('title');
			$product->description = Input::get('description');
			$product->regular_price = Input::get('regular_price');
			$product->delux_price = Input::get('delux_price');
			$product->premium_price = Input::get('premium_price');
			$product->product_code = Input::get('product_code');
			if($product->save()){
				Session::flash('message', 'Product has been edited sccessfully.');
				return Redirect::to('/admin/products/viewall');
			}else{
				Session::flash('message', 'Some error with the product edit. Please try again later.');
				return Redirect::to('/admin/products/viewall');
			}
		}
	}
}
?>