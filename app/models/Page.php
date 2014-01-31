<?php

class Page extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'url' => 'required'
	);
}
