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

		$('.photo-delete').click(function(){

			var $photoDiv = $(this).parent();

			$.ajax({
				url: "{{slink::to('admin/galleries/photo/delete')}}",
				data: { id: $(this).attr('data-photo-id') },
				type: 'post',
            }).done(function(){
            	$photoDiv.fadeOut('fast');
            }).fail(function(data){
            	console.log(data);
            });
           
			return false;
		});
	});
	</script>

@stop

@section('content')

	@foreach ($gall->photos as $photo)

		<div><img src="{{$upload_dir.$photo->name}}" alt="" style="border: 1px solid; max-width: 150px; max-height: 150px;">
		<a href="#" class="photo-delete" data-photo-id="{{$photo->id}}">Delete</a></div>

	@endforeach

<form action="{{slink::path('admin/galleries/upload')}}" class="dropzone dz-clickable" id="mydropzone">
	<input type="hidden" name="gallery-id" value="{{$gall->id}}">
</form>

@stop