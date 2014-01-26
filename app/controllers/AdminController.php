<?php

class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function mainPage()
	{
		$groups = User::find(Auth::user()->id)->groups;
		foreach($groups as $group)
		{
			echo $group->name."\n";
			$id = $group->id;
			$roles = Group::find($id)->roles;
			foreach($roles as $role)
			{
				echo $role->name."\n";
			}
		}
		echo "Current language: ".Config::get('app.locale');
		//return View::make('admin.index');
	}

}