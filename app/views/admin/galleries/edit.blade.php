@extends('layouts.admin.index')

@section('plugins')

	<script src="{{URL::to('public/admin_template/js/plugin/dropzone/dropzone.min.js')}}"></script>
	<script>
	$(document).ready(function() {
		Dropzone.autoDiscover = false;
			$("#mydropzone").dropzone({
				//url: "/file/post",
				addRemoveLinks : false,
				maxFilesize: 0.5,
				dictResponseError: 'Error uploading file!'
			});
	});
	</script>

@stop

@section('content')

<?php
	$gall = gallery::findOrFail($id);
	print_r($gall->id);
?>

<form action="{{slink::path('admin/galleries/upload')}}" class="dropzone dz-clickable" id="mydropzone"></form>

@stop