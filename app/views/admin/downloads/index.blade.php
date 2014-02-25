@extends('layouts.admin.index')

@section('plugins')
	
<script src="{{slink::path('admin_template/js/plugin/dropzone/dropzone.min.js')}}"></script>
<script>
	$("#main").dropzone({ url: "/file/post" });
</script>

@stop

@section('content')

<!--<div style="margin-bottom: 25px;">
	<a class="btn btn-primary" data-toggle="modal" data-target="#lang">Add new language</a>
</div>-->
<table class="table table-bordered table-striped">
<tbody>

	@if(isset($back_link))
		<tr><td><a href="?path={{$back_link}}"><i class="fa fa-fw fa-level-up"></i> Back</a></td></tr>
	@endif

	@if(!empty($dirs))
		@foreach($dirs as $url => $dir)
			<tr><td><a href="?path={{$url}}"><i class="fa fa-fw fa-folder-open"></i> {{$dir}}</a></td></tr>
		@endforeach
	@endif

	@if(!empty($files))
		@foreach($files as $url => $file)
			<tr><td><a href="{{$url}}" target="_blank"><i class="fa fa-fw fa-file-text"></i> {{$file}}</a></td></tr>
		@endforeach
	@endif

</tbody>
</table>

@stop