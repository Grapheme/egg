<?php

class shortcode {

	public static function view($options, $data)
	{
		if(isset($options['name']))
		{
			$name = $options['name'];
			if (View::exists("tmp.".$name)) { return View::make("tmp.".$name, $data); } else 
											{ return "Error: (".$name." not found)"; }

		} else {
			return "Error: name of view is not defined!";
		}
	}

	public static function gallery($options)
	{
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
	}

	public static function news($options)
	{
		$limit = 5;
		$view = 'list';
		//Default options

		if(isset($options['view'])) 	{ $view = $options['view']; }
    	if(isset($options['limit'])) 	{ $limit = $options['limit']; }

    	$string = "";
    	$news = news::where('language', Config::get('app.locale'))->take($limit)->get();

    	if($view == 'list') 
    	{
    		return View::make('layouts.news-list', compact('news'));
		}
		elseif($view == 'calendar') {
			return View::make('layouts.news-calendar', compact('news'));
		}

	}

	public static function map($options)
	{
		if(!isset($options['width'])) 	$options['width'] = '500';
		if(!isset($options['height'])) 	$options['height'] = '500';
		if(!isset($options['zoom'])) 	$options['zoom'] = '5';
		//Default options

		if(!isset($options['title'])) 	{ $title = null; } 		else { $title = "hintContent: '{$options['title']}'"; }
		if(!isset($options['preview']))	{ $preview = null; }	else { $preview = "balloonContent: '{$options['preview']}'"; }
		if( $title == null && $preview == null)
		{
			$placemark = null;
		} else {
			$placemark = 	'myPlacemark = new ymaps.Placemark(['.$options['position'].'], {
			                '.$title.'
			                '.$preview.'
			            	});
							myMap.geoObjects.add(myPlacemark);';
		}

		$map = '<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
			    <script type="text/javascript">
			        ymaps.ready(init);
			        var myMap, 
			            myPlacemark;

			        function init(){ 
			            myMap = new ymaps.Map ("map", {
			                center: ['.$options['position'].'],
			                zoom: '.$options['zoom'].'
			            }); 
			            '.$placemark.'
			        }
			    </script>';
		$div = '<div id="map" style="width: '.$options['width'].'px; height: '.$options['height'].'px;"></div>';
		return $map.$div;
	}
}