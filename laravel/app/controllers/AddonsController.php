<?php

class AddonsController extends BaseController {

	public function __construct(){
		parent::__construct();
		$this->beforeFilter('csrf',array('on'=>'post'));
	}

	public function getIndex(){
		return View::make('addons.index')
				->with('addons',Addon::where('vendor_id','=',Auth::user()->id));
	}

	public function postCreate(){
		$validator = Validator::make(Input::all(),Addon::$rules);

		if($validator->passes()){
			$addon =  new Addon;
			$addon->type = Input::get('type');
			$addon->description = Input::get('description');
			$addon->price = Input::get('price');
			$addon->vendor_id = Auth::user()->id;

			$image = Input::file('image');
			$filename = date('Y-m-d-H:i:s')."-".$image->getClientOriginalName();
			$path = public_path('img/addons/' . $filename);
			Image::make($image->getRealPath())->resize(468,249)->save($path);
			$addon->image = 'img/addons/'.$filename;

			$addon->save();

			return Redirect::to('admin/addons/index')
				->with('message','Addon created.');
		}
			return Redirect::to('admin/addons/index')
				->with('message','Addon not created. Something went wrong.')
				->withErrors($validator)
				->withInput();
	}

	
}
?>