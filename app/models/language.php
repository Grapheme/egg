<?php

class language extends Eloquent {
	protected $guarded = array();

	protected $table = 'languages';

	public static $rules = array(
		'code' => 'required',
		'name' => 'required'
	);

}