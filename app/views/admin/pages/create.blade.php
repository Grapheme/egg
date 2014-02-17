@extends('layouts.admin.index')

@section('plugins')
    
    <script src="<?=URL::to('admin_template/js/plugin/summernote/summernote.js')?>"></script>
    <script>
        $('.editor').summernote({
                height: 250
        });

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

                  }).always(function(data){
                    console.log(data);
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

<h1>Create Page</h1>

<form class="smart-form ajax-form" action="<?=URL::to('admin/pages/store')?>" method="post" id="edit-from">
    <section>
        <label class="label">Name</label>
        <label class="input">
            <input type="text" class="input-lg" name="name">
        </label>
    </section>
    <section>
        <label class="label">URL</label>
        <label class="input">
            <input type="text" class="input-lg" name="url">
        </label>
    </section>

    <div class="tab-pane active" id="hr2">

    <ul class="nav nav-tabs">

    <?php $active = true; ?>
    @foreach ($langs = language::all() as $lang)
        <li class="<?php if($active) echo "active"; ?>">
            <a href="#{{$lang->code}}" data-toggle="tab">{{$lang->name}}</a>
        </li>
        <?php $active = false; ?>
    @endforeach

    </ul>

    <div class="tab-content padding-10">

    <?php $langs = slang::get('array'); ?>
    <?php $active = true; ?>
        @foreach ($langs as $lang)
            <?php
                $columns = array(
                    'title' => 'title_'.$lang,
                    'description' => 'description_'.$lang,
                    'keywords' => 'keywords_'.$lang,
                    'content' => 'content_'.$lang,
                );
            ?>
            <div class="tab-pane <?php if($active) echo "active";?>" id="{{$lang}}">
                <section>
                    <label class="label">Title</label>
                    <label class="input">
                        <input type="text" class="input-lg" name="{{$columns['title']}}">
                    </label>
                </section>
                <section>
                    <label class="label">Description</label>
                    <label class="input">
                        <input type="text" class="input-lg" name="{{$columns['description']}}">
                    </label>
                </section>
                <section>
                    <label class="label">Keywords</label>
                    <label class="input">
                        <input type="text" class="input-lg" name="{{$columns['keywords']}}">
                    </label>
                </section>
                <section>
                    <label class="label">Content</label>
                    <label class="input">
                        <div class="editor" name="{{$columns['content']}}"></div>
                    </label>
                </section>
            </div>
            <?php $active = false; ?>
        @endforeach


        </div>
    </div>
</form>

<a class="btn btn-success btn-save-n-close" href="<?=URL::previous()?>" data-id="edit-from">Create</a>

@stop


