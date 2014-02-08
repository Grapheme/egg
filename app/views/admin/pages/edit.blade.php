@extends('layouts.admin.index')

@section('plugins')
    
    <script src="<?=URL::to('public/admin_template/js/plugin/summernote/summernote.js')?>"></script>
    <script>
        $('.editor').summernote({
                height: 250
        });
        function editorSave() {
            var aHTML = $('.editor').code();
        }
        function saveBtn(that, close)
        {
            var $formId = $(that).attr('data-id');
            var $form = $('#' + $formId);
            var $dataArray = {};
            $form.find('input.input-lg').each(function(){
                $dataArray[$(this).attr('name')] = ($(this).val());
            });

            $dataArray.content_en = $('.editor').code();


              $.ajax({
                  url: $form.attr('action'),
                  data: $dataArray,
                  type: 'post',
                  success: function(data) {

                    var json = JSON.parse(data);
                    if(json.success)
                    {
                        $.bigBox({
                            title : "Page saved",
                            color : "#739E73",
                            timeout: 2500,
                            icon : "fa fa-check",
                        });

                        if(close === true)
                        {
                            window.location.href = $(that).attr('href');
                        }

                    } else {
                        
                        var $fields = "";

                        $form.find('.input').removeClass('state-error');

                        for(key in json.errors)
                        {
                            $('input[name=' + json.errors[key] + ']').parent().addClass('state-error');
                            //console.log($('input[name=' + json.errors[key] + ']'));
                            $fields += " " + json.errors[key];
                        }

                        var $errorPos = $form.find('.state-error').first().parent().position().top;

                        if($(window).scrollTop() > $errorPos)
                        {
                            $('html, body').animate({ scrollTop: $errorPos });
                        }
                            
                        $.bigBox({
                            title : "Error!",
                            content : "These fields aren't correct:" + $fields,
                            color : "#C46A69",
                            timeout: 15000,
                            icon : "fa fa-warning shake animated",
                        });

                    }
                    
                  }
                });

        }

        $('.btn-just-save').click(function(){
            saveBtn($(this));
            return false;
        });

        $('.btn-save-n-close').click(function(){
            saveBtn($(this), true);
            return false;
        });

    </script>

@stop

@section('content')
<!--
<h1>Edit Page</h1>
{{ Form::model($page, array('method' => 'PATCH', 'route' => array('admin.pages.update', $page->id))) }}
	<ul>
        <?=$page->name?>
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
            {{ Form::textarea('content_en') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('admin.pages.show', 'Cancel', $page->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}
-->
<form class="smart-form ajax-form" action="<?=URL::to('admin/ajax/page/update/'.$page->id)?>" method="post" id="edit-from">
    <input class="input-lg" type="hidden" name="id" value="<?=$page->id?>">
    <section>
        <label class="label">Name</label>
        <label class="input">
            <input type="text" class="input-lg" value="<?=$page->name?>" name="name">
        </label>
    </section>
    <section>
        <label class="label">URL</label>
        <label class="input">
            <input type="text" class="input-lg" value="<?=$page->url?>" name="url">
        </label>
    </section>
    <section>
        <label class="label">Title</label>
        <label class="input">
            <input type="text" class="input-lg" value="<?=$page->title_en?>" name="title_en">
        </label>
    </section>
    <section>
        <label class="label">Description</label>
        <label class="input">
            <input type="text" class="input-lg" value="<?=$page->description_en?>" name="description_en">
        </label>
    </section>
    <section>
        <label class="label">Keywords</label>
        <label class="input">
            <input type="text" class="input-lg" value="<?=$page->keywords_en?>" name="keywords_en">
        </label>
    </section>
    <section>
        <label class="label">Content</label>
        <label class="input">
            <div class="editor" name="content_en"><?=$page->content_en?></div>
        </label>
    </section>
</form>

<a class="btn btn-primary btn-just-save" data-id="edit-from">Save</a>

<a class="btn btn-success btn-save-n-close" href="<?=URL::previous()?>" data-id="edit-from">Save and quit</a>

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
