<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{{$title}}}</title>
	<meta name="description" content="{{{$description}}}">
	<meta name="keywords" content="{{{$keywords}}}">
	<meta name="author" content="">
	<link rel="shortcut icon" href="{{asset('favicon.png');}}">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
	{{ HTML::style('system/css/news.css') }}
	{{ HTML::script('system/js/vendor/modernizr-2.6.2.min.js') }}
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Меню навигации</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
			@if(Request::is('/'))
				<a href="javascript:void(0)" class="navbar-brand">Moneta.ru</a>
			@else
				<a href="{{url('/');}}" class="navbar-brand">Moneta.ru</a>
			@endif
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				{{$menu}}
			</div>
		</div>
	</nav>
	 <div class="container">
		<div class="row">
			 <div class="col-lg-8">