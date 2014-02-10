<?php

class gallery extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required'
	);

	public function photos()
	{
		return $this->hasMany('photo');
	}
}