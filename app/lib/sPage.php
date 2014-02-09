<?php

class sPage {

	public static function show($url)
	{

		$page = Page::where('url', $url)->firstOrFail();
		if($page == null) {
			App::abort(404);
			exit;
		}
		$content_lang = 'content_'.Config::get('app.locale');
		$text = $page->$content_lang;
		preg_match_all('/\[view=(.*?)\]/', $text, $reg);

		if(!empty($reg[0]))
		{
			foreach($reg[1] as $reged)
			{
				if (View::exists($reged))
				{
					$reg_view[] = View::make($reged);
				} else {
					$reg_view[] = "(".$reged." not found)";
				}
			}
			$text = str_replace($reg[0], $reg_view, $text);
		}

		return $text;
	}
}