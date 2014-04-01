@extends('layouts.admin.index')

@section('style')
<link rel="stylesheet" href="{{slink::path('system/css/admin/redactor.css')}}" />
@stop

@section('plugins')
<script src="{{slink::path('system/js/admin/redactor.js')}}"></script>
<script src="{{slink::path('system/js/admin/redactor-config.js')}}"></script>
<script>

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
        $('textarea[name=content]').text(data);

    }).fail(function(data){
        console.log(data);

    });
});

</script>
@stop

@section('content')
<form class="ajax-form" action="<?=URL::to('admin/pages/update/'.$page->id)?>" method="post" id="edit-from">
<article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">
    <div class="smart-form">
        <header>General</header>
        <fieldset>
            <input class="input-lg" type="hidden" name="id" value="{{$page->id}}">
            <section>
                <label class="label">Name</label>
                <label class="input">
                    <input type="text" class="input-lg" value="{{$page->name}}" name="name">
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
                <label class="label">Content</label>
                <label class="textarea">
                    <textarea name="content" style="height: 300px;" class="editor">{{$page->content}}</textarea>
                </label>
            </section>
        </fieldset>
    </div>
</article>
<article class="col-sm-12 col-md-12 col-lg-6 sortable-grid ui-sortable">
    <div class="smart-form">
        <header>Seo</header>
        <fieldset>
            <section>
                <label class="toggle" style="display: inline-block;">
                    <input type="checkbox" name="in_menu" @if($page->in_menu == 1) checked="checked" @endif value="1">
                    <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Show in menu: 
                </label>
            </section>
            <input class="input-lg" type="hidden" name="id" value="{{$page->id}}">
            <section>
                <label class="label">URL</label>
                <label class="input">
                    <input type="text" class="input-lg" value="{{$page->url}}" name="url">
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
        </fieldset>
    </div>
    <a class="btn btn-primary btn-just-save" data-id="edit-from">Save</a>
    <a class="btn btn-success btn-save-n-close" href="{{URL::previous()}}" data-id="edit-from">Save and quit</a>
    <a style="float: right;" class="btn btn-default" target="_blank" href="{{slink::to($page->url)}}">Go to page</a>
</article>
</form>
@stop
