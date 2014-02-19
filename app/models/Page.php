<?php

class Page extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'url' => 'required'
	);

	public static function menu()
	{
		$pages = self::where('in_menu', 1)->get();

		$array = [];

		foreach($pages as $page)
		{
			$array[$page->url] = $page->name;
		}

		return View::make('layouts.menu', array('menu' => $array));
	}
}
