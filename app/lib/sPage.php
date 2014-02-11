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
		$data = array('title' => $page->title_en);
		preg_match_all('/\[(.*?)=(.*?)\]/', $text, $reg);

		if(!empty($reg[0]))
		{
			for($i = 0; $i < count($reg[0]); $i++)
			{	
				$type = $reg[1][$i];
				$name = $reg[2][$i];

				switch ($type) {
				    case "view":
				        if (View::exists($name))
						{
							$reg_view[] = View::make($name, $data);
						} else {
							$reg_view[] = "Error: (".$name." not found)";
						}
				        break;
				    	
			    	case "gallery":
				       
				        if(gallery::where('name', $name)->exists())
				        {

				        } else {
				        	$reg_view[] = "Error: Gallery {$name} doesn't exist";
				        }
				        break;
				}
			}
			$text = str_replace($reg[0], $reg_view, $text);
		}



		return $text;
	}
}