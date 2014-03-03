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
        $('textarea[name=content]').text(data);

    }).fail(function(data){
        console.log(data);

    });
        });