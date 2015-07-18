<?php 

class CitySeeder extends Seeder{
	public function run(){
		DB::table('cities')->delete();
		City::create(array('name'=>'Agra'));
		City::create(array('name'=>'Ahmedabad'));
		City::create(array('name'=>'Ambala'));
		City::create(array('name'=>'Amravati'));
		City::create(array('name'=>'Amritsar'));
		City::create(array('name'=>'Anand'));
		City::create(array('name'=>'Bangalore'));
		City::create(array('name'=>'Bareilly'));
		City::create(array('name'=>'Bharuch'));
		City::create(array('name'=>'Bhavnagar'));
		City::create(array('name'=>'Bhopal'));
		City::create(array('name'=>'Bhubaneswar'));
		City::create(array('name'=>'Chandigarh'));
		City::create(array('name'=>'Chennai'));
		City::create(array('name'=>'Coimbatore'));
		City::create(array('name'=>'Dehradun'));
		City::create(array('name'=>'Delhi'));
		City::create(array('name'=>'Ernakulam'));
		City::create(array('name'=>'Faridabad'));
		City::create(array('name'=>'Gandhidham'));
		City::create(array('name'=>'Gandhinagar'));
		City::create(array('name'=>'Ghaziabad'));
		City::create(array('name'=>'Gurgaon '));
		City::create(array('name'=>'Gwalior'));
		City::create(array('name'=>'Haridwar '));
		City::create(array('name'=>'Hyderabad'));
		City::create(array('name'=>'Indore'));
		City::create(array('name'=>'Jabalpur'));
		City::create(array('name'=>'Jaipur'));
		City::create(array('name'=>'Jalandhar'));
		City::create(array('name'=>'Jalgaon'));
		City::create(array('name'=>'Jamnagar'));
		City::create(array('name'=>'Jamshedpur'));
		City::create(array('name'=>'Jhansi'));
		City::create(array('name'=>'Kanpur'));
		City::create(array('name'=>'Kolkata'));
		City::create(array('name'=>'Lucknow'));
		City::create(array('name'=>'Ludhiana'));
		City::create(array('name'=>'Madurai'));
		City::create(array('name'=>'Mangalore'));
		City::create(array('name'=>'Mohali'));
		City::create(array('name'=>'Mumbai'));
		City::create(array('name'=>'Mysore'));
		City::create(array('name'=>'Nagpur'));
		City::create(array('name'=>'Nashik'));
		City::create(array('name'=>'Noida'));
		City::create(array('name'=>'Patna'));
		City::create(array('name'=>'Pimpri Chinchwad'));
		City::create(array('name'=>'Pune'));
		City::create(array('name'=>'Rajkot'));
		City::create(array('name'=>'Secunderabad'));
		City::create(array('name'=>'Surat'));
		City::create(array('name'=>'Thane'));
		City::create(array('name'=>'Thiruvananthapuram'));
		City::create(array('name'=>'Vadodara'));
		City::create(array('name'=>'Visakhapatnam'));
	}

}

?>