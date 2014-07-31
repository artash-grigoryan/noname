
function forgotPwd()
{
    var mail = $("#mail").val();
    if(mail != '')
    {
        $.ajax({
            url: base_path + 'users/forgotPassword/',
            type: 'POST',
            data:{
                mode:   'ajax',
                mail:   mail
            },
            success: function(data) {
                var $div = $('<div/>', {
                    'class'     : 'message info'
                });
                var $p = $('<p/>').html(data);
                $div.html($p);
                $('#message_info_block').html($div);
            }
        });
    }
    else
    {
        var $div = $('<div/>', {
            'class'     : 'message info'
        });
        var $p = $('<p/>').html('Veuillez entrer un E-Mail');
        $div.html($p);
        $('#message_info_block').html($div);
        $('#content.loginbox .message').remove();
    }
}

$(function (){
    $(document).on('submit', '.loginbox form', function(){
        sendForm(this, 'text', function(data){
            var $div = $('<div/>', {
            'class'     : 'message info'
        });
        var $p = $('<p/>').html(data);
        $div.html($p);
        $('#message_info_block').html($div);
        $('#content.loginbox .message').remove();
        });
        return false;
    })
    
    $('.registration_link').on('click', function(){
        $('#locked-login-page').find('h2').html('Enregistrement');
        $('#login_form').hide();
        $('#registration_form').show();
        $(this).hide();
        return false;
    });
    
    $('#registration_form').on('submit', 'form', function(){
        sendForm(this, 'text', function(data){
            var $div = $('<div/>', {
            'class'     : 'message info'
        });
        var $p = $('<p/>').html(data);
        $div.html($p);
        $('#message_info_block').html($div);
        $('#content.loginbox .message').remove();
        });
        return false;
    });
});