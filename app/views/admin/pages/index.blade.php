@extends('layouts.admin.index')

@section('plugins')

<script>

	$(".btn-danger").click(function(e) {
		var $form = $(this).parent();
		$.SmartMessageBox({
			title : "Deleting page!",
			content : "You're going to delete this page?",
			buttons : '[No][Yes]'
		}, function(ButtonPressed) {
			if (ButtonPressed === "Yes") {
				$.ajax({
					url: $form.attr('action'),
					type: 'post',
				}).done(function(){
					$form.parent().parent().fadeOut();
				}).fail(function(data){
					console.log(data);
				});
			}
			if (ButtonPressed === "No") {
				return false;
			}

		});
		e.preventDefault();
	});

</script>

@stop

@section('content')

<div style="margin-bottom: 25px;">
	<a class="btn btn-primary" href="<?=slink::to('admin/pages/create')?>">Add new page</a>
</div>

@if ($pages->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Url</th>
				<th>Title_en</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($pages as $page)
				<tr>
					<td>{{{ $page->name }}}</td>
					<td>{{{ $page->url }}}</td>
					<td>{{{ $page->title_en }}}</td>
                    <td><a href="{{slink::to('admin/pages/'.$page->id.'/edit/')}}" class="btn btn-info">Edit</a></td>
                    <td>
                        <form method="POST" action="{{slink::to('admin/pages/'.$page->id.'/destroy')}}">
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        </form>
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no pages
@endif

@stop
