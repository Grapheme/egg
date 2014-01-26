<?php

class slang {

	public static function get()
	{
		$languages = array('ru','en');
		$locale = Request::segment(1);
		if(in_array($locale, $languages)){
			App::setLocale($locale);
		}else{
			$locale = null;
		}

		return $locale;
	}
}