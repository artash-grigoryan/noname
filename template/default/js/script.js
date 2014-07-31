$(function(){
    $('#overlay').on('click', function (e) {
        $('#content-overlay').slideUp(500, function(){
            $('#content-overlay').html('');
        });
        $('#overlay').fadeOut(500);
    });

    $('#content-overlay').on('click', function (e) {
        e.stopPropagation();
    });
    
    
    var $window = $(window);
    //parallax
    $('section[data-type="background"]').each(function(){
        var $bgobj = $(this); // assigning the object
     
        $window.scroll(function() {
            
            var yPos = ($window.scrollTop() / $bgobj.data('speed'));
             
            // Put together our final background position
            var coords = 2*yPos + 'px 50%';
 
            // Move the background
            $bgobj.css({ backgroundPosition: coords });
        });
    });   
});
