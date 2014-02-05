@extends('layouts.admin.index')

@section('plugins')
    
    <script src="<?=URL::to('public/admin_template/js/plugin/ckeditor/ckeditor.js')?>"></script>

@stop

@section('content')

<h1>Edit Page</h1>
{{ Form::model($page, array('method' => 'PATCH', 'route' => array('admin.pages.update', $page->id))) }}
	<ul>
        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('url', 'Url:') }}
            {{ Form::text('url') }}
        </li>

        <li>
            {{ Form::label('title_en', 'Title_en:') }}
            {{ Form::text('title_en') }}
        </li>

        <li>
            {{ Form::label('description_en', 'Description_en:') }}
            {{ Form::textarea('description_en') }}
        </li>

        <li>
            {{ Form::label('keywords_en', 'Keywords_en:') }}
            {{ Form::textarea('keywords_en') }}
        </li>

        <li>
            {{ Form::label('content_en', 'Content_en:') }}
            {{ Form::textarea('content_en', null, array('class' => 'ckeditor')) }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('admin.pages.show', 'Cancel', $page->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
