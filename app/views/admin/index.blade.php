@extends('layouts.admin.index')

@section('main')

<?php
	$groups = User::find(Auth::user()->id)->groups;
	foreach($groups as $group)
	{
		echo $group->name."\n";
		$id = $group->id;
		$roles = Group::find($id)->roles;
		foreach($roles as $role)
		{
			echo $role->name."\n";
		}
	}
	echo "Current language: ".Config::get('app.locale');
	echo "<br><a href='logout'>Logout</a>"
?>

@stop