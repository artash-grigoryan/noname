function displayChildren(parentId)
{
    var url = path + 'users/getPartnerChildren/' + ((typeof(parentId) != 'undefined') ? '?parentId='+ parentId : '') ;

    var dataForm = 'mode=ajax';
    $.ajax({
        type     : "GET",
        dataType : 'json',
        url      : url,
        data     : dataForm,
        success  : function(data) {

            if(!$.isEmptyObject(data.children)) {

                $(data.children).each(function(){

                    var container = $('<li/>', {
                        'id' : 'user_'+this.id
                    });

                    var userContainer = $('<a/>', {
                        'class': 'user_name',
                        'href' : path + 'users/account/?id='+this.id,
                        'text' : this.first_name + ' ' + this.last_name
                    }).appendTo(container);

                    var childrenContainer = $('<ul/>', {
                        'class': 'tree'
                    }).appendTo(container);

                    if(data.admin) {

                        $('<li/>', {
                            'class': 'new_user_link'
                        }).append($('<a/>', {
                                        'href' : path + 'users/addPartner/?parentId='+this.id+'&form=1',
                                        'text' : 'Ajouter un partenaire'
                        })).appendTo(childrenContainer);
                    }

                    var treeContainer = $(document).find('#user_'+parentId).find('.tree');
                    if(treeContainer.length == 0) {

                        treeContainer = $('#original_tree');
                    }
                    treeContainer.prepend(container);
                    displayChildren(this.id);
                });
            }
        }
    });
}

$(function(){
    displayChildren();
});