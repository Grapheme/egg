<?php

class Page extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'url' => 'required',
		'language' => 'required'
	);

	public static function menu()
	{
		$pages = self::orderBy('sort_menu', 'asc')->where('in_menu', 1)->get();

		$menu = [];
		foreach($pages as $page)
		{
			$menu[$page->url] = $page->name;
		}

		return View::make('layouts.menu', compact('menu'));
	}
}
