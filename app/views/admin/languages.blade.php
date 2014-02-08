@extends('layouts.admin.index')

@section('content')

<?php
	$langs = language::all();
?>

<div style="margin-bottom: 25px;">
	<a class="btn btn-primary" data-toggle="modal" data-target="#lang">Add new language</a>
</div>
<table class="table table-bordered table-striped">
<thead>
	<tr>
		<th>Code</th>
		<th>Name</th>
	</tr>
</thead>
<tbody>
	<?php
		foreach($langs as $lang)
		{
			echo "<td>".$lang->code."</td>";
			echo "<td>".$lang->name."</td>";
			echo "<td><a href='".slink::to('admin/languages/'.$lang->id.'/edit')."'>Edit</a></td>";
		}
	?>
</tbody>
</table>

<div class="modal fade in" id="lang" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					×
				</button>
				<h4 class="modal-title" id="myModalLabel">Add new language</h4>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col-md-12">
						<form id="add-lang">
							<div class="form-group">
								<label>Code:</label>
								<input type="text" class="form-control" name="code">
							</div>
							<div class="form-group">
								<label>Name:</label>
								<input class="form-control" name="name">
							</div>
							<a class="btn-just-save" data-id="add-lang">Add</a>
						</form>
					</div>
				</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

@stop