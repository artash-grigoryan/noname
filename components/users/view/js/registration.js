
$(function (){

    $('.cancel').on('click', function(){
        $('input').removeClass('error');
        $('.notification').remove();
        $('form').find('input').each(function(){
            $(this).val('');
        });
        return false;
    });

    $('#registration_form').on('submit', function(){
        $('input').removeClass('error');
        return verifForm(this);
    });
});