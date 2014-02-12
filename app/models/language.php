<?php

class language extends Eloquent {
	protected $guarded = array();

	protected $table = 'languages';

	public static $rules = array(
		'code' => 'required|unique:languages',
		'name' => 'required'
	);

	public static function getRules()
	{
		return self::$rules;
	}

}