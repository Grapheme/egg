@extends('layouts.admin.index')

@section('style')
<link rel="stylesheet" href="{{slink::path('system/css/admin/redactor.css')}}" />
@stop

@section('plugins')
<script src="{{slink::path('system/js/admin/redactor.js')}}"></script>
<script>

$('.editor').redactor({ 
    minHeight: 200
});

function saveBtn(that, close)
{
    var $formId = $(that).attr('data-id');
    var $form = $('#' + $formId);
    var $dataArray = $form.serialize();

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
        $('.redactor_editor').text(data);

    }).fail(function(data){
        console.log(data);

    });
});

</script>
@stop

@section('content')
<form class="ajax-form" action="<?=slink::to('admin/pages/store')?>" method="post" id="edit-from">
<article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">
    <div class="smart-form ">
        <header>General</header>
        <fieldset>
            <section>
                <label class="label">Name</label>
                <label class="input">
                    <input type="text" class="input-lg" name="name">
                </label>
            </section>
            <section>
                <label class="label">Language</label>
                <label class="select">
                    <select name="language">
                        @foreach($langs as $lang)
                        <option value="{{$lang->code}}">{{$lang->name}}</option>
                        @endforeach
                    </select> <i></i>
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
                <label class="textarea">
                    <textarea name="content" style="height: 150px;" class="editor"></textarea>
                </label>
            </section>
        </fieldset>
    </div>
</article>

<article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">
    <div class="smart-form ">
        <header>Seo</header>
        <fieldset>
            <section>
                <label class="toggle" style="display: inline-block;">
                    <input type="checkbox" name="in_menu" value="1">
                    <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Show in menu: 
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
                    <input type="text" class="input-lg" name="title">
                </label>
            </section>
            <section>
                <label class="label">Description</label>
                <label class="input">
                    <input type="text" class="input-lg" name="description">
                </label>
            </section>
            <section>
                <label class="label">Keywords</label>
                <label class="input">
                    <input type="text" class="input-lg" name="keywords">
                </label>
            </section>
            <button class="btn btn-success btn-save-n-close" href="<?=URL::previous()?>" data-id="edit-from">Create</button>
        </fieldset>
    </div>
</article>
</form>

@stop


