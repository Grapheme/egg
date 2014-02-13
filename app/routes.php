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
	    Route::get('users', 'UsersController@index');


	    Route::group(array('before' => 'admin_panel', 'prefix' => 'pages'), function()
		{
			Route::get('/', 'PagesController@index');
			Route::get('{id}/edit', 'PagesController@edit');
			Route::get('create', 'PagesController@create');
			Route::post('{id}/destroy', 'PagesController@destroy');
			Route::post('update/{id}', 'PagesController@update');
			Route::post('store', 'PagesController@store');

		});


	    Route::group(array('before' => 'admin_panel', 'prefix' => 'languages'), function()
		{
			Route::get('/', 'LangController@index');
			Route::post('create', 'LangController@create');
			Route::post('delete', 'LangController@delete');
		});


	    Route::group(array('before' => 'admin_panel', 'prefix' => 'galleries'), function()
		{
	    	Route::get('', 'GalleriesController@index');
	    	Route::get('{id}/edit', 'GalleriesController@edit');
	    	Route::post('upload', 'GalleriesController@upload');
	    	Route::post('create', 'GalleriesController@create');
	    	Route::post('delete', 'GalleriesController@delete');
	    	Route::post('photo/delete', 'GalleriesController@deletePhoto');
	    });

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
		if(Page::where('url', '404')->exists())
		{
			return spage::show('404');
		} else {
			return "Page is not found, and 'Page 404' has not been created. That is why you see this page<br>Egg CMS. <a href='//grapheme.ru' style='color: #cacaca;' target='_blank'>Grapheme.ru</a>";
		}
	}
});