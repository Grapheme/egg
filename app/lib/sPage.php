<?php

class sPage {

	public static function shortcode($clear, $data = '')
	{
		$str = explode(" ", $clear);
		$type = $str[0];

		if(!isset($str[1]))
		{
			// no options
		} else {

			// options
			$options = [];
			for($i = 1; $i < count($str); $i++)
			{
				preg_match_all('/(.*?)=\"(.*?)\"/', $str[$i], $rendered);
				if(!empty($rendered[0]))
				{
					$options[$rendered[1][0]] = $rendered[2][0];
				}
			}
		}

		switch ($type) 
		{
			case "view":

				if(isset($options['name']))
				{
					$name = $options['name'];

					if (View::exists("tmp.".$name))
					{
						return View::make("tmp.".$name, $data);
					} else {
						return "Error: (".$name." not found)";
					}
				} else {
					return "Error: name of view is not defined!";
				}

				break;

			case "gallery":

				if(isset($options['name']))
				{

				$name = $options['name'];
				       
			        if(gallery::where('name', $name)->exists())
			        {
			        	$gall = gallery::where('name', $name)->first();
			        	$photos = $gall->photos;
			        	$str = "";

			        	foreach($photos as $photo)
			        	{
			        		$str .= "<li><img src=\"{$photo->path()}\" alt=\"\" style=\"max-width: 150px;\"></li>";
			        	}

			        	return "<ul>".$str."</ul>";

			        } else {
			        	return "Error: Gallery {$name} doesn't exist";
			        }

			    } else {
					return "Error: name of gallery is not defined!";
				}

		        break;

		    case "news":

		    	// Default number
		    	$number = 5;
		    	if(isset($options['number']))
		    	{
		    		$number = $options['number'];
		    	}

		    	$string = "";
		    	$news = news::getAmount($number);

		    	foreach($news as $new)
		    	{
		    		$string .= $new->title;
		    	}

		    	return $string;

		    	break;

		    case "snippet":

		    	return $options['string'];

		    	break;


		}
	}

	public static function show($url)
	{	

		$page = Page::where('url', $url)->first();
		if($page == null) {
			App::abort(404);
			exit;
		}
		$content_lang = 'content_'.Config::get('app.locale');
		$text = $page->$content_lang;
		$columns = array(
			'title' => 'title_'.Config::get('app.locale')
		);
		$data = array('title' => $page->$columns['title'], 'menu' => Page::menu());
		preg_match_all('/\[(.*?)\]/', $text, $reg);

		$regs = [];

		for ($j = 0; $j < count($reg[0]); $j++) {
			$regs[$reg[0][$j]] = $reg[1][$j];
		}

		$change = [];
		$to = [];

		foreach($regs as $tocange => $clear)
		{
			$change[] = $tocange;
			if(explode(' ', $clear)[0] == 'view')
			{
				$to[] = self::shortcode($clear, $data);
			} else {
				$to[] = self::shortcode($clear);
			}

		}

		$text = str_replace($change, $to, $text);

		return $text;

	}

}