<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'user' => 'admin',
			'password' => Hash::make('awesome'),
		));
	}

}