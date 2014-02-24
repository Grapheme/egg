@extends('layouts.admin.index')

@section('content')

<?php
	$users = User::all();
?>

<!--<div style="margin-bottom: 25px;">
	<a class="btn btn-primary" data-toggle="modal" data-target="#lang">Add new language</a>
</div>-->
<table class="table table-bordered table-striped">
<thead>
	<tr>
		<th>id</th>
		<th>Username</th>
	</tr>
</thead>
<tbody>
	<?php
		foreach($users as $user)
		{
			if($user->id == Auth::user()->id)
			{
				echo "<td>".$user->id." (you)</td>";
			} else {
				echo "<td>".$user->id."</td>";
			}
			echo "<td>".$user->user."</td>";
		}
	?>
</tbody>
</table>

@stop