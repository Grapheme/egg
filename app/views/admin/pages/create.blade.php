@extends('layouts.scaffold')

@section('main')

<h1>Create Page</h1>

{{ Form::open(array('route' => 'admin.pages.store')) }}
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
            {{ Form::text('content_en') }}
        </li>

		<li>
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


