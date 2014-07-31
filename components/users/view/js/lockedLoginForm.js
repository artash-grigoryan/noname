
$(function (){

    $('.registration_link').on('click', function(){
        $('#login').hide();
        $('#registration').show();
        return false;
    });

    $('.cancel').on('click', function(){
        $('input').removeClass('error');
        $('.notification').remove();
        $('#login').show();
        $('#registration').hide();
        $('form').find('input').each(function(){
            $(this).val('');
        });
        return false;
    });

    $('#login_form').on('submit', function(){
        $('input').removeClass('error');
        return verifForm(this);
    });

    $('#registration_form').on('submit', function(){
        $('input').removeClass('error');
        return verifForm(this);
    });
});