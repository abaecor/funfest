<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	public static function fetch_name($id) {
		$user_det = User::find($id);
		if(isset($user_det->firstname)){
			$name = $user_det->firstname." ".$user_det->lastname;	
		}else{
			$name = "";
		}
        
        return $name;
    }
    public static function fetch_cakevendor_name($id) {
		$user_det = User::where('uniq_ven_id','=',$id)->get()->toArray();
		$user_det = $user_det[0];
		if(isset($user_det['firstname'])){
			$name = $user_det['firstname']." ".$user_det['lastname'];	
		}else{
			$name = "";
		}
        return $name;
    }
    public static function getrmn($id) {
		$user_det = User::find($id);
		if(isset($user_det->rmn)){
			$rmn = $user_det->rmn;
		}else{
			$rmn = "";
		}
        
        return $rmn;
    }
	public static function cakegetid($venid) {
		$user_det = User::where('uniq_ven_id','=',$venid)->get()->toArray();
		if(isset($user_det[0]['id'])){
			$id = $user_det[0]['id'];
		}else{
			$id = "";
		}

		return $id;
	}
    public static function getemail($id) {
		$user_det = User::find($id);
		if(isset($user_det->email)){
			$email = $user_det->email;
		}else{
			$email = "";
		}
        
        return $email;
    }

	public static function getvendorcode($id) {
		$user_det = User::find($id);
		if(isset($user_det->uniq_ven_id)){
			$uniq_ven_id = $user_det->uniq_ven_id;
		}else{
			$uniq_ven_id = "";
		}

		return $uniq_ven_id;
	}
}
