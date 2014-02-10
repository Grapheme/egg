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
		preg_match_all('/\[(.*?)=(.*?)\]/', $text, $reg);

		if(!empty($reg[0]))
		{
			for($i = 0; $i < count($reg[0]); $i++)
			{	
				switch ($reg[1][$i]) {
				    case "view":
				        if (View::exists($reg[2][$i]))
						{
							$reg_view[] = View::make($reg[2][$i]);
						} else {
							$reg_view[] = "(".$reg[2][$i]." not found)";
						}
				        break;
				    	
			    	case "gallery":
				        $reg_view[] = "Галлерея маза фака";
				        break;
				}
			}
			$text = str_replace($reg[0], $reg_view, $text);
		}



		return $text;
	}
}