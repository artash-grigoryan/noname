
function submitMail(form)
{
    var url = $(form).attr('action');
    var formData = $(form).serialize();
    
    $.ajax({
            type : "POST",
            url  : url + '&' +formData,
            data : { 
                        mode   : "ajax"
            },
            success: function(data)
            {
                var $div = $('<div/>', {
                    'class'     : 'message info'
                });
                var $p = $('<p/>').html(data);
                $div.html($p);
                $('#message_info_block').html($div);
            }
    });
    return false;
}


