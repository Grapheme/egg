<?php

class HomeController extends BaseController {

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

	public function showNews($id){
		if($news = news::find($id)){
			$title = $news->page_title;
			$description = $news->page_description;
			$keywords = $news->page_keywords;
			$menu = Page::menu();
			return View::make('layouts.news',compact('news','title','description','keywords','menu'));
		}else{
			return App::abort(404);
		}
		
	}

	public function showPage($url = null)
	{
		//$firstTime = microtime(true);
		if($url == null) {
			echo spage::show('');
		} else {
			echo spage::show($url);
		}
		//echo slink::to('admin-template/index.html');
		//echo microtime(true) - $firstTime;
	}

	public function loginPage()
	{
		return View::make('admin.login');
	}

	public function login()
	{
		if(Input::get('remember') == 'on') 	{ $rem = true; } else 
											{ $rem = false; }

		if(Auth::attempt(array('user' => Input::get('user'), 'password' => Input::get('password')), $rem))
		{
			return Redirect::to('admin');
		} else {
			return Redirect::back()->with('message', 'Password or user isn\'t correct.');
		}
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
}