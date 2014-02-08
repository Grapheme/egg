<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'id' => 1,
			'user' => 'admin',
			'password' => Hash::make('awesome'),
		));

		DB::table('languages')->delete();
		language::create(array(
			'code' => 'en',
			'name' => 'english',
			'default' => 1,
		));

		DB::table('groups')->delete();
		Group::create(array(
			'id' => 1,
			'name' => 'admin',
			'desc' => 'Administrators',
		));

		DB::table('roles')->delete();
		role::create(array(
			'id' => 1,
			'name' => 'admin_panel',
			'desc' => 'administrator panel',
		));


		$admin = User::find(1);
		$admin->groups()->attach(1);

		$group = group::find(1);
		$group->roles()->attach(1);

	}

}