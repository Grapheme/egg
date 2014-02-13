@extends('layouts.admin.index')

@section('plugins')
    
    <script src="<?=URL::to('public/admin_template/js/plugin/summernote/summernote.js')?>"></script>
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

            $dataArray.content_en = $('.editor').code();


              $.ajax({
                  url: $form.attr('action'),
                  data: $dataArray,
                  type: 'post',
                  success: function(data) {

                    
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

                        var json = JSON.parse(data);
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
    <section>
        <label class="label">Title</label>
        <label class="input">
            <input type="text" class="input-lg" name="title_en">
        </label>
    </section>
    <section>
        <label class="label">Description</label>
        <label class="input">
            <input type="text" class="input-lg" name="description_en">
        </label>
    </section>
    <section>
        <label class="label">Keywords</label>
        <label class="input">
            <input type="text" class="input-lg" name="keywords_en">
        </label>
    </section>
    <section>
        <label class="label">Content</label>
        <label class="input">
            <div class="editor" name="content_en"></div>
        </label>
    </section>
</form>

<a class="btn btn-success btn-save-n-close" href="<?=URL::previous()?>" data-id="edit-from">Create</a>

@stop


