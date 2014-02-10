@extends('layouts.admin.index')

@section('content')

<?php
	$galls = gallery::all();
?>

<div style="margin-bottom: 25px;">
	<a class="btn btn-primary" data-toggle="modal" data-target="#lang">Add new gallery</a>
</div>
<table class="table table-bordered table-striped">
<thead>
	<tr>
		<th>Name</th>
	</tr>
</thead>
<tbody>
	<?php
		foreach($galls as $gall)
		{
			?>

			<td>{{$gall->name}}</td>
			<td><a href="{{URL::to('admin/galleries/'.$gall->id.'/edit')}}">Edit</a></td>

			<?php
		}
	?>
</tbody>
</table>

@stop