<?php

class CouponsController extends BaseController {

	public function __construct(){
		parent::__construct();
	}

	public function getAddcoupons(){
		return View::make('coupons.addcoupons');
	}

	public function postAddcoupons(){
		$coupon = new Coupon;
		$coupon->code = Input::get('coupon_code');
		$coupon->discount = Input::get('discount');
		$coupon->min_val = Input::get('min_val');
		$coupon->expiry = Date('Y-m-d',strtotime(Input::get('validity')));
		$coupon->type = (Input::get('category_id') == 'cb') ? 'cashback' : 'discount';
		$coupon->status = 'activated';
		if($coupon->save()){
			Session::flash('message', 'Coupon has been added sccessfully.'); 
			return View::make('coupons.addcoupons');
		}
	}

	public function getViewall(){
		$fields = array(DB::raw('count(*) as total'),'id','min_val','code','batchuniqid','expiry','type','discount','status','parent_id');
		return View::make('coupons.viewall')
				->with('coupons',Coupon::orderBy('created_at', 'DESC')->groupBy('batchuniqid')->paginate(10,$fields));
	}

	public function postAddbatch(){
		$batchuniqid = Input::get('label').date('d-m-y-h-i-s');
		$temp_array = "";
		for($i=0;$i<intval(Input::get('number'));$i++){
			$temp_array[]  = substr(base_convert(sha1(uniqid(mt_rand())),16,36),0,7);	
		}
		$unique_array = array_unique($temp_array);
		if(count($unique_array) == Input::get('number')){
			for ($i=0; $i < intval(Input::get('number')); $i++) { 
				$coupon = new Coupon;
				$coupon->code  = strtoupper(Input::get('label').$unique_array[$i]);
				$coupon->discount = Input::get('discount');
				$coupon->expiry = Date('Y-m-d',strtotime(Input::get('validity')));
				$coupon->type = (Input::get('category_id') == 'cb') ? 'cashback' : 'discount';
				$coupon->status = 'activated';
				$coupon->min_val = Input::get('min_val');
				$coupon->parent_id = Input::get('referal');
				$coupon->batchuniqid = $batchuniqid;
				$coupon->save();
			}
			Session::flash('message', 'Coupon has been added sccessfully.'); 
			return View::make('coupons.addcoupons');

		}else{

			Session::flash('message', 'Some issue with code generation please try again.'); 
			return View::make('coupons.addcoupons');
		}
		
	}

	public function getDelete(){
		if($_GET['process'] == 'batch'){
			$coupons = Coupon::where('batchuniqid','=',$_GET['id']);
		}else{
			$coupons = Coupon::where('id','=',$_GET['id']);
		}
		if($coupons->delete()){
			Session::flash('message', 'Coupon has been deleted sccessfully.'); 
			return Redirect::to('/admin/coupons/viewall');
		}
		
	}

	public function getEdit(){
		if($_GET['process'] == 'batch'){
			$fields = array(DB::raw('count(*) as total'),'id','min_val','code','batchuniqid','expiry','type','discount','status','parent_id');
			$coupons = Coupon::where('batchuniqid', '=',$_GET['id'])->groupBy('batchuniqid')->get($fields);
		}else{
			$coupons = Coupon::where('id','=',$_GET['id'])->get();
		}
		return View::make('coupons.edit')
				->with('coupons',$coupons);
	}

	public function postEdit(){
		$batch = Input::get('batch') ? 1 : 0;
		if($batch){
			$get_all = Coupon::where('batchuniqid', '=',Input::get('batchuniqid'))->get();
			foreach ($get_all as $key => $value) {
				$coup = Coupon::find($value->id);
				$coup->batchuniqid = Input::get('batchuniqid');
				$coup->discount = Input::get('Discount');
				$coup->type = Input::get('Type');
				$coup->parent_id = Input::get('Parent_Id');
				$coup->min_val = Input::get('min_val');
				$coup->expiry = Input::get('Expiry');
				$coup->save();
			}
			Session::flash('message', 'All coupons has been updated sccessfully.'); 
			return Redirect::to('coupons/viewall');
		}else{
			$coup = Coupon::find(Input::get('id'));
			$coup->batchuniqid = Input::get('batchuniqid');
			$coup->code = Input::get('batchuniqid');
			$coup->discount = Input::get('Discount');
			$coup->type = Input::get('Type');
			$coup->parent_id = Input::get('Parent_Id');
			$coup->expiry = Input::get('Expiry');
			$coup->status = Input::get('Status');
			$coup->min_val = Input::get('min_val');
			$coup->save();
			Session::flash('message', 'Coupon has been updated sccessfully.'); 
			return Redirect::to('coupons/viewall');
		}
		Session::flash('message', 'Coupon update failed.'); 
		return Redirect::to('coupons/viewall');
	}

	public function getDownload(){
		$batchid = $_GET['batchid'];
		$all_coupons = Coupon::where('batchuniqid','like','%'.$batchid.'%')->get()->toArray();
//		echo "<pre>";print_r($all_coupons);
		Excel::create('Coupons-'.date("Y-m-d",time()), function($excel) use($all_coupons){

		    $excel->sheet('Sheetname', function($sheet) use($all_coupons){

		        $sheet->fromArray($all_coupons);

		    });

		})->export('xls')->download('xls');
		return Redirect::to('coupons.viewall')
				->with('coupons',Coupon::orderBy('created_at', 'DESC')->groupBy('batchuniqid')->paginate(10,$fields));
	}

	public function postVerify(){
		echo $_POST['orderid'];
		echo $_POST['code'];
	}
}
?>