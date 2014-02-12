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

	Route::group(array('before' => 'admin_panel', 'prefix' => 'admin'), function()
	{
	    Route::get('/', 'AdminController@mainPage');

	    Route::resource('pages', 'PagesController');
	    Route::get('users', 'UsersController@index');
	    Route::get('languages', 'LangController@index');


	    Route::group(array('before' => 'admin_panel', 'prefix' => 'galleries'), function()
		{
	    	Route::get('', 'GalleriesController@index');
	    	Route::get('{id}/edit', 'GalleriesController@edit');
	    	Route::post('upload', 'GalleriesController@upload');
	    	Route::post('create', 'GalleriesController@create');
	    	Route::post('delete', 'GalleriesController@delete');
	    	Route::post('photo/delete', 'GalleriesController@deletePhoto');
	    });


	    /*	
		AJAX routing
		*/

		Route::post('ajax/page/update/{id}', 'PagesController@update');
		Route::post('ajax/page/create', 'PagesController@store');
	});

	//Route::resource('groups', 'GroupsController');

	Route::get('/{url}', 'HomeController@showPage');
	Route::get('/', 'HomeController@showPage');

});

App::missing(function($exception)
{
	if(slink::segment(1) == 'admin' && allow::to('admin_panel'))
	{
		return View::make('admin.error404');
		exit;
	} else {
		//return spage::show('404');
	}
});