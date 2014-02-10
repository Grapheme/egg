@extends('layouts.admin.index')

@section('content')

<?php
	$gal = gallery::find(1)->photos;
	print_r($gal);
?>

@stop