<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

$locale = slang::get();

Route::group(array('prefix' => $locale), function()
{

	Route::get('login', array('before' => 'login', function(){
		return View::make('admin.login');
	}));
	Route::post('login', array('as' => 'login', 'uses' => 'HomeController@login'));
	Route::get('logout', 'HomeController@logout');

	Route::group(array('before' => 'auth', 'prefix' => 'admin'), function()
	{
	    Route::get('/', 'AdminController@mainPage');

	    Route::resource('pages', 'PagesController');
	});

	//Route::resource('groups', 'GroupsController');

	Route::get('/{url}', 'HomeController@showPage');
	Route::get('/', 'HomeController@showPage');

});

App::missing(function($exception)
{
    return sPage::show('404');
});