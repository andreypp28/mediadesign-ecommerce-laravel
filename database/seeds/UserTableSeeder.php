<?php

use Illuminate\Database\Seeder;
use App\Models\User; 

class UserTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->delete();
        
        $salt = str_random(8);
		User::create([
			'email'     => 'admin@rockdesign.com',
			'passsalt'  => $salt,
            'password'  => md5($salt.'password'),
            'firstname' => 'James',
            'lastname'  => 'Stewart',
			'user_type' => 1,
            'is_active' => 1,
            'active_code' => null,
		]);
        $this->command->info('Admin User created with email admin@rockdesign.com and password password');
        
        $salt = str_random(8);
		User::create([
            'email'     => 'stuff@rockdesign.com',
            'passsalt'  => $salt,
            'password'  => md5($salt.'password'),
            'firstname' => 'David',
            'lastname'  => 'Jhon',
            'user_type' => 0,
            'is_active' => 1,
            'active_code' => null,
        ]);
        
        $this->command->info('Stuff User created with email stuff@rockdesign.com and password password');
	}

}
