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

            $('.editor').each(function(){
                $dataArray[$(this).attr('name')] = $(this).code();
            });


              $.ajax({
                  url: $form.attr('action'),
                  data: $dataArray,
                  type: 'post',
                  }).done(function(){

                    $form.find('.input').removeClass('state-error');

                    $.bigBox({
                            title : "Page saved",
                            color : "#739E73",
                            timeout: 7000,
                            icon : "fa fa-check",
                        });

                        if(close === true)
                        {
                            window.location.href = $(that).attr('href');
                        }

                  }).fail(function(data){

                        var $errors = JSON.parse(data.responseJSON);

                        $form.find('.input').removeClass('state-error');

                        for(var key in $errors)
                        {
                            $('input[name=' + key + ']').parent().addClass('state-error');
                            //console.log($('input[name=' + json.errors[key] + ']'));
                        }

                        $errorPos = $form.find('.state-error').first().parent().position().top;

                        if($(window).scrollTop() > $errorPos)
                        {
                            $('html, body').animate({ scrollTop: $errorPos });
                        }
                            
                        $.bigBox({
                            title : "Error!",
                            content : data.responseJSON,
                            color : "#C46A69",
                            timeout: 7000,
                            icon : "fa fa-warning shake animated",
                        });

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

<form class="smart-form ajax-form" action="<?=URL::to('admin/pages/update/'.$page->id)?>" method="post" id="edit-from">
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


    <?php $langs = slang::get('array'); ?>

    <?php $active = false; ?>
    @foreach ($langs as $lang)
        <?php
            $columns = array(
                'title' => 'title_'.$lang,
                'description' => 'description_'.$lang,
                'keywords' => 'keywords_'.$lang,
                'content' => 'content_'.$lang,
            );
        ?>

        <h2>{{$lang}}:</h2>
            <section>
                <label class="label">Title</label>
                <label class="input">
                    <input type="text" class="input-lg" value="<?=$page->$columns['title']?>" name="{{$columns['title']}}">
                </label>
            </section>
            <section>
                <label class="label">Description</label>
                <label class="input">
                    <input type="text" class="input-lg" value="<?=$page->$columns['description']?>" name="{{$columns['description']}}">
                </label>
            </section>
            <section>
                <label class="label">Keywords</label>
                <label class="input">
                    <input type="text" class="input-lg" value="<?=$page->$columns['keywords']?>" name="{{$columns['keywords']}}">
                </label>
            </section>
            <section>
                <label class="label">Content</label>
                <label class="input">
                    <div class="editor" name="{{$columns['content']}}"><?=$page->$columns['content']?></div>
                </label>
            </section>
    @endforeach

</form>

<a class="btn btn-primary btn-just-save" data-id="edit-from">Save</a>

<a class="btn btn-success btn-save-n-close" href="<?=URL::previous()?>" data-id="edit-from">Save and quit</a>

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
