@extends('layouts.admin.index')

@section('plugins')

	<script src="{{slink::path('admin_template/js/plugin/summernote/summernote.js')}}"></script>
	<script src="{{slink::path('system/js/admin/ajax_submit.js')}}"></script>
	<script>
	
		$('.editor').summernote({
                height: 250
        });

        $('form').ajax_submit('{{slink::to('admin/news/')}}');

	</script>

@stop

@section('content')

	<form action="{{slink::to('admin/news/update/'.$new->id)}}" class="smart-form">
		<section>
	        <label class="label">Language</label>
	        <label class="input">
	            <select name="language">

					@foreach($languages as $id => $lang)
						<option value="{{$lang['code']}}" @if($lang['code'] == $new->language) selected="selected" @endif>{{$lang['name']}}</option>
					@endforeach

				</select>
	        </label>
	    </section>
	    <section>
            <label class="label">Page Title</label>
            <label class="input">
                <input type="text" class="input-lg" name="page_title" value="{{{$new->page_title}}}">
            </label>
        </section>
        <section>
            <label class="label">Page Description</label>
            <label class="input">
                <input type="text" class="input-lg" name="page_description" value="{{{$new->page_description}}}">
            </label>
        </section>
        <section>
            <label class="label">Page Keywords</label>
            <label class="input">
                <input type="text" class="input-lg" name="page_keywords" value="{{{$new->page_keywords}}}">
            </label>
        </section>
		<section>
		<section>
	        <label class="label">Title</label>
	        <label class="input">
	            <input type="text" class="input-lg" name="title" value="{{{$new->title}}}">
	        </label>
	    </section>
	    <section>
	        <label class="label">Preview</label>
	        <label class="input">
	            <div class="editor" name="preview">{{$new->preview}}</div>
	        </label>
	    </section>
	    <section>
	        <label class="label">Text</label>
	        <label class="input">
	            <div class="editor" name="content">{{$new->content}}</div>
	        </label>
	    </section>
	    <section>
	        <label class="label">Date</label>
	        <label class="input">
	            <input type="text" class="input-lg" name="updated_at" value="{{$new->updated_at}}">
	        </label>
	    </section>
	    <section>
	    	<button type="submit" class="btn btn-primary">Save and quit</button>
	    	<button class="btn ajax-save">Save</button>
	    	<button onclick="window.open('{{slink::to('news/'.$new->id)}}');return false;" class="btn btn-default" style="float: right;">Go to news</button>
	    </section>
	</form>

@stop