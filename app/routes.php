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

//$locale = slang::get();

$locale = null;

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

	    Route::controller('users', 'UsersController');
		Route::controller('pages', 'PagesController');
		Route::controller('languages', 'LangController');
		Route::controller('galleries', 'GalleriesController');


/*	    Route::group(array('before' => 'admin_panel', 'prefix' => 'galleries'), function()
		{
	    	Route::get('', 'GalleriesController@index');
	    	Route::get('{id}/edit', 'GalleriesController@edit');
	    	Route::post('upload', 'GalleriesController@upload');
	    	Route::post('create', 'GalleriesController@create');
	    	Route::post('delete', 'GalleriesController@delete');
	    	Route::post('photo/delete', 'GalleriesController@deletePhoto');
	    });*/

	});

	//Route::resource('groups', 'GroupsController');

	Route::get('/{url}', 'HomeController@showPage');
	Route::get('/', 'HomeController@showPage');

});