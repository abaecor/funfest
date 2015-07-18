<?php

class UsersController extends BaseController{
	
	public function __construct(){
		parent::__construct();
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getNewaccount(){
		$type = $_GET['type'];
		return View::make('users.newaccount')
				->with('type',$type);
	}

	public function postCreate(){
		// $validator = Validator::make(Input::all(), User::$rules);
		
		// if($validator->passes()){
			
			$user = new User;
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->username = Input::get('username');
			$user->uniq_ven_id = Input::get('uniq_ven_id');
			$user->password = Hash::make(Input::get('password'));
			$user->address = Input::get('address');
			$user->email = Input::get('email');
			$user->phone = Input::get('phone');
			// $type = Input::get('type');
			// if( $type == 'vendor'){
			// 	$user->isVendor = 1;
			// }else{
			$user->isVendor = 0;
			// }
			$user->status = 'active';
			if($user->save()){
				return Redirect::to('home/index')
					->with('message','Thank you for your account has been created.');
			}
	
			Mail::send('emails.welcome', array(), function($message)
			{
			    $message->from('care@littleflorist.com', 'Littleflorist');
			    $message->to(Input::get('email'));
			});

			return View::make('users.newaccount')
					->with('message','Something went wrong')
					->withErrors($validator);
	}

	public function postUpdate(){
		$validator = Validator::make(Input::all(), User::$rules);

		if($validator->passes()){
			$user = User::find(Auth::user()->id);

			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->username = Input::get('username');
			$user->address = Input::get('address');
			$user->email = Input::get('email');
			$user->phone = Input::get('phone');
			$user->password = Input::get('password');
			$user->save();

			Mail::send('emails.update', array(), function($message)
			{
			    $message->from('care@littleflorist.com', 'Littleflorist');

			    $message->to(Input::get('email'));

			    // $message->attach($pathToFile);
			});
			
			return Redirect::to('users/myaccount')
					->with('message','Your account has been updated.');
		}
		return Redirect::to('home/index')
				->with('message','Something went wrong')
				->withErrors($validator)
				->withInput();
	}

	public function getSignin(){
		//return View::make('users.signin');
		return Redirect::to('home/index');
	}

	public function postSignin(){
		$type="";
		if(Input::has('type')){
			$type = Input::get('type');
		}
		if($type="merchant"){
			$options = array('username'=>Input::get('username'),'password'=>Input::get('password'),'status'=>'active','isVendor'=>1);
		}else if($type="user"){
			$options = array('username'=>Input::get('username'),'password'=>Input::get('password'),'status'=>'active','isVendor'=>0);
		}
		if(Auth::attempt($options)){
			return Redirect::to('/')->with('message','Thanks for signing in');
		}
		return Redirect::to('/home/index')->with('message','Sorry invalid credentials');
	}

	public function getSignout(){
		Auth::logout();
		return Redirect::to('/')->with('message','You have been signed out.');
	}

	public function getMyaccount(){
		return View::make('users.myaccount')->with('user',Auth::user());
	}

	public function getViewall(){
		$vendors = User::where('isVendor','=','1')->paginate(20);
		return View::make('vendors.viewall')
				->with('vendors',$vendors);	
	}

	public function getEdit($id){
		$vendors = User::find($id);

		return View::make('vendors.edit')
				->with('vendors',$vendors);		
	}

	public function postEdit(){
		$vendor = User::find(Input::get('id'));
		$vendor->uniq_ven_id = Input::get('uniq_ven_id');
		$vendor->firstname = Input::get('firstname');
		$vendor->lastname = Input::get('lastname');
		$vendor->username = Input::get('username');
		$vendor->address = Input::get('address');
		$vendor->phone = Input::get('phone');
		$vendor->status = Input::get('status');
		if($vendor->save()){
			Session::flash('message', 'Vendor has been edited successfully.'); 
			return Redirect::to('/admin/users/myaccount');
		}else{
			Session::flash('message', 'Vendor was not edited. Please try again later.'); 
			return Redirect::to('/admin/users/myaccount');
		}
	}

	public function getDelete($id){
		$vendors = User::find($id);
		if($vendors->delete()){
			Session::flash('message', 'Vendor has been deleted successfully.'); 
			return Redirect::to('/admin/users/myaccount');
		}
		Session::flash('message', 'Vendor was not deleted.'); 
		return Redirect::to('/admin/users/myaccount');
	}

	public function postVendbatch(){
		$file = Input::file('excel_file');
		$result = Excel::load($file, function($reader) {
		 		$reader->take(100);
		 })->toArray();
		$data = array_filter($result);
		foreach($data as $k=>$v){
			$vendor = User::find($v['vendor_id']);
			if($vendor == ""){
				$newvendor = new User;
				$newvendor->uniq_ven_id = $v['uniq_ven_id'];
				$newvendor->firstname = $v['firstname'];
				$newvendor->lastname = $v['lastname'];
				$newvendor->username = $v['username'];
				$newvendor->password = Hash::make($v['password']);
				$newvendor->address = $v['address'];
				$newvendor->email = $v['email'];
				$newvendor->phone = $v['phone'];
				$newvendor->status = $v['status'];
				$newvendor->isVendor = 1;
				$newvendor->save();	
			}else{
				$vendor->uniq_ven_id = $v['uniq_ven_id'];
				$vendor->firstname = $v['firstname'];
				$vendor->lastname = $v['lastname'];
				$vendor->username = $v['username'];
				$vendor->password = Hash::make($v['password']);
				$vendor->address = $v['address'];
				$vendor->email = $v['email'];
				$vendor->phone = $v['phone'];
				$vendor->status = $v['status'];
				$vendor->save();	
			}
		}
		Session::flash('message', 'All vendor edited successfully.');
		return Redirect::to('/users/viewall');
	}

	public function getAddaddress($id){
		return View::make('vendors.addaddress');
	}

	public function postAddaddress(){
		// Input::get('postcode');
		$save_add = new Address;
		$save_add->user_id = Auth::user()->id;
		$save_add->address = Input::get('address');
		if($save_add->save()){
			Session::flash('message', 'Address saved successfully.');
			return Redirect::to('/users/myaccount');
		}
	}

	public function getMyaddress(){
		$user_id = Auth::user()->id;
		$base_address = User::where('id','=',$user_id)->get(array('address'))->toArray();
		$other_add = Address::where('user_id','=',$user_id)->get()->toArray();
		return View::make('users.myaddress')
				->with('base_address',$base_address)
				->with('other_add',$other_add);
	}
}

?>