$(function(){
    $('#sessions_actives').on('click', 'a.delete_session', function(event){
        event.preventDefault();
        var link = this;
        ajaxLink(link, 'text', function(data){
            if(data) {
                $(link).parents('.panel').fadeOut(500, function(){
                    $(this).remove();
                });
            }
        });
    });
    
    $('#account-info').on('click', 'a.update_info', function(event){
        event.preventDefault();
        var link = this;
        ajaxLink(link, 'text', function(data){
            $('#account-info').find('.account_block').fadeOut(500, function(){
                $('#account-info').html(data);
            });
        });
    });
    
    $('#account-info').on('submit', 'form', function(event){
        event.preventDefault();
        var form = this;
        sendForm(form, 'text', function(data){
            $(form).fadeOut(500, function(){
                $('#account-info').html(data);
                addNotification('success', 'Vos informations ont été mises à jour');
            });
        });
    });

    $(document).on('click', '.cancel', function(){
        window.location.reload();
    });
});