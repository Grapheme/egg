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

            $form.find('select[name=language]').each(function(){
                $dataArray[$(this).attr('name')] = ($(this).val());
            });

            if($('input[name=in_menu]').is(':checked'))
            {
                $dataArray['in_menu'] = $('input[name=in_menu]').val();
            } else {
                $dataArray['in_menu'] = 0;
            }

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

        $('.template-select').on('change', function(){

            $_select = $(this);

            $.ajax({
                url: '{{slink::to('admin/temps/insert/')}}',
                data:  { id: $_select.val() },
                type: 'post'
            }).done(function(data){
                $('.note-editable').text(data);

            }).fail(function(data){
                console.log(data);

            });
        });


    </script>

@stop

@section('content')

<article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">

    <div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-1" data-widget-editbutton="false" role="widget" style="">

        <div role="content">

            <div class="widget-body">

                <form class="smart-form ajax-form" action="<?=URL::to('admin/pages/update/'.$page->id)?>" method="post" id="edit-from">
                    <label class="toggle">
                        <input type="checkbox" name="in_menu" @if($page->in_menu == 1) checked="checked" @endif value="1">
                        <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Show in menu: 
                    </label>

                    <input class="input-lg" type="hidden" name="id" value="{{$page->id}}">
                    <section>
                        <label class="label">Name</label>
                        <label class="input">
                            <input type="text" class="input-lg" value="{{$page->name}}" name="name">
                        </label>
                    </section>
                    <section>
                        <label class="label">URL</label>
                        <label class="input">
                            <input type="text" class="input-lg" value="{{$page->url}}" name="url">
                        </label>
                    </section>

                    <section>
                        <label>Language</label>
                        <label class="select">
                            <select name="language">
                                @foreach($langs as $lang)
                                <option value="{{$lang->code}}">{{$lang->name}}</option>
                                @endforeach
                            </select> <i></i>
                        </label>
                    </section>

                    <section>
                        <label class="label">Title</label>
                        <label class="input">
                            <input type="text" class="input-lg" name="title" value="{{$page->title}}">
                        </label>
                    </section>
                    <section>
                        <label class="label">Description</label>
                        <label class="input">
                            <input type="text" class="input-lg" name="description" value="{{$page->description}}">
                        </label>
                    </section>
                    <section>
                        <label class="label">Keywords</label>
                        <label class="input">
                            <input type="text" class="input-lg" name="keywords" value="{{$page->keywords}}">
                        </label>
                    </section>
                    <section>
                        <label class="label">Content</label>
                        <section>
                            <label class="select">
                                <select class="template-select">
                                    <option value="0">Select template</option>
                                    @foreach($temps as $temp)
                                    <option value="{{$temp->id}}">{{$temp->name}}</option>
                                    @endforeach
                                </select> <i></i>
                            </label>
                        </section>
                        <label class="input">
                            <div class="editor" name="content">{{$page->content}}</div>
                        </label>
                    </section>

                </form>

                <a class="btn btn-primary btn-just-save" data-id="edit-from">Save</a>
                <a class="btn btn-success btn-save-n-close" href="<?=URL::previous()?>" data-id="edit-from">Save and quit</a>

            </div>

        </div>

    </div>

</article>

@stop
