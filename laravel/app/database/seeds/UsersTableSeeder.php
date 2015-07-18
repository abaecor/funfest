<?php 

class UsersTableSeeder extends Seeder{

	public function run(){
		$user  = new User;
		$user->firstname = 'Gaurav';
		$user->lastname = 'Kumar';
		$user->password = Hash::make('mypassword');
		$user->email = 'gkumar@lf.com';
		$user->status = 'active';
		$user->address = 'test address';
		$user->phone = '09898989898';
		$user->isVendor = 0;
		$user->isSuper = 1;
		$user->save();
	}

}

?>