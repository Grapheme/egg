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
		$number = 5;
		//Default limit of news

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
	}

	public static function map($options)
	{
		if(!isset($options['width'])) 	$options['width'] = '500px';
		if(!isset($options['height'])) 	$options['height'] = '500px';
		//Default options

		if(!isset($options['title'])) 	{ $title = null; } 		else { $title = "hintContent: '{$options['title']}'"; }
		if(!isset($options['preview']))	{ $preview = null; }	else { $preview = "balloonContent: '{$options['preview']}'"; }
		if( $title == null && $preview == null)
		{
			$placemark = null;
		} else {
			$placemark = 'myPlacemark = new ymaps.Placemark(['.$options['position']'], {
			                '.$title.'
			                '.$preview.'
			            	});';
		}

		$map = '<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
			    <script type="text/javascript">
			        ymaps.ready(init);
			        var myMap, 
			            myPlacemark;

			        function init(){ 
			            myMap = new ymaps.Map ("map", {
			                center: ['.$options['position'].'],
			                zoom: 7
			            }); 
			            '.$placemark.'
			            myMap.geoObjects.add(myPlacemark);
			        }
			    </script>';
		$div = '<div id="map" style="width: '.$options['width'].'; height: '.$options['height'].'"></div>';
		return $map.$div;
	}
}