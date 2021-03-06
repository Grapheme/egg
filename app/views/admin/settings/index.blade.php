@extends('layouts.admin.index')

@section('plugins')
	
<script>
	
	$(function(){
		$('.lang-change').on('change', function(){
			var $_form = $(this).parent();
			var $id = $(this).val();
			$.ajax({
				url: $_form.attr('action'),
				data: { id: $id },
				type: 'post',	
			}).done(function(data){
				$.smallBox({
					title : "Settings saved!",
					content : "",
					color : "#296191",
					iconSmall : "fa fa-thumbs-up bounce animated",
					timeout : 4000
				});
			});
		});

		$('.module-checkbox').on('change', function(){
			var $checkbox = $(this);
			if(!$checkbox.is(':checked'))
			{
				var $url = '{{slink::to('admin/settings/moduleon')}}';
			} else {
				var $url = '{{slink::to('admin/settings/moduleoff')}}'
			}

			$.ajax({
				url: $url,
				data: { url: $checkbox.attr('data-url') },
				type: 'post'
			}).done(function(data){
				$.smallBox({
					title : "Settings saved!",
					content : "",
					color : "#296191",
					iconSmall : "fa fa-thumbs-up bounce animated",
					timeout : 4000
				});
			});
		});
	});

</script>

@stop

@section('content')

<table>

	<tr>
		<td>Admin panel language: </td>
	<td>
		<form action="{{slink::to('admin/settings/adminlanguagechange')}}">
			<select class="lang-change">

				@foreach($languages as $id => $lang)
					<option value="{{$id}}" @if($lang['code'] == $settings['admin_language']['value']) selected="selected" @endif>{{$lang['name']}}</option>
				@endforeach

			</select>
		</form>
	</td>
	</tr>

</table>
<div class="smart-form">
<table style="margin-top:55px; width: 400px;" class="table table-bordered table-striped">

	@foreach(admin::menuArray() as $url => $option)

	<tr>
		<td>{{$option[0]}}</td>
		<td style="width: 50px;">
			<label class="toggle">
    			<input @if(!modules::where('url', $url)->exists()) checked="checked" @endif type="checkbox" class="module-checkbox" data-url="{{$url}}">
                <i data-swchon-text="ON" data-swchoff-text="OFF"></i> 
            </label>
		</td>
	</tr>

	@endforeach

</table>
</div>
@stop