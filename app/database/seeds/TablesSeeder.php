<?php

class TablesSeeder extends Seeder
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
			'name' => 'English',
			'default' => 1,
		));
		/*language::create(array(
			'code' => 'ru',
			'name' => 'Русский',
			'default' => 0,
		));*/

		DB::table('groups')->delete();
		group::create(array(
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
		role::create(array(
			'id' => 2,
			'name' => 'admin_news',
			'desc' => 'Edit news',
		));
		role::create(array(
			'id' => 3,
			'name' => 'admin_pages',
			'desc' => 'Edit pages',
		));
		role::create(array(
			'id' => 4,
			'name' => 'admin_users',
			'desc' => 'Users managment',
		));

		DB::table('settings')->delete();
		settings::create(array(
			'id' => 1,
			'name' => 'admin_language',
			'value' => 'en',
		));


		$admin = User::find(1);
		$admin->groups()->attach(1);

		$group = group::find(1);
		$group->roles()->attach(1);

	}

}