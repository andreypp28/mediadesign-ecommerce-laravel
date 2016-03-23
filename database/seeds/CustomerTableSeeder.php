<?php

use Illuminate\Database\Seeder;
use App\Models\Customer; 

class CustomerTableSeeder extends Seeder {

	public function run()
	{
        DB::table('customers')->delete();
        
        $salt = str_random(8);
		Customer::create([
			'email'     => 'andreypp28@gmail.com',
            'passsalt'  => $salt,
			'password'  => md5($salt.'andreypp28'),
            'firstname' => 'Andrey',
            'lastname'  => 'Popov',
            'is_active' => '1',
            'active_code' => null,
		]);
        $this->command->info('Customer created with email andreypp28@gmail.com and password andreypp28');
        
        $salt = str_random(8);    
		Customer::create([
            'email'     => 'bond@outlook.com',
            'passsalt'  => $salt,
            'password'  => md5($salt.'bondbond'),
            'firstname' => 'Jamed',
            'lastname'  => 'Bond',
            'is_active' => '1',
            'active_code' => null,
        ]);
        
        $this->command->info('Customer created with email bond@outlook.com and password bondbond');
	}

}
