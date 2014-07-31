function activeCamera()
{
    var streaming = false,
        video        = document.querySelector('#video'),
        cover        = document.querySelector('#cover'),
        canvas       = document.querySelector('#canvas'),
        photo        = document.querySelector('#photo'),
        startbutton  = document.querySelector('#startbutton'),
        reloadbutton = document.querySelector('#reloadbutton'),
        savebutton   = document.querySelector('#savebutton'),
        width = 600,
        height = 0;

    navigator.getMedia = ( navigator.getUserMedia ||
                        navigator.webkitGetUserMedia ||
                        navigator.mozGetUserMedia ||
                        navigator.msGetUserMedia);

    navigator.getMedia(
        {
            video: true,
            audio: false
        },
        function(stream) {
            if (navigator.mozGetUserMedia) {
                video.mozSrcObject = stream;
            } else {
                var vendorURL = window.URL || window.webkitURL;
                video.src = vendorURL.createObjectURL(stream);
            }
            video.play();
        },
        function(err) {
            console.log("An error occured! " + err);
        }
    );

    video.addEventListener('canplay', function(ev){
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth/width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
                streaming = true;
        }
    }, false);

    function takepicture() {
        height = video.videoHeight / (video.videoWidth/width);
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);

        $('#canvas').show();
        $('#video').hide();
        $('#startbutton').hide();
        $('#reloadbutton').show();
        $('#savebutton').show();
    }

    function savePicture()
    {
        $('#savebutton').html('Sauvegarde ...');
        $('#savebutton').addClass('active');

        var imageData = canvas.toDataURL('image/png');
        $.ajax({
                url: base_path,
                type: "POST",
                data: { option:     'users',
                        action:     'updatePhoto',
                        action_file:'save',
                        mode:       'ajax',
                        imageData:  imageData
                },
                success: function(data) {
                    window.location.href=base_path+'users/account/';
                }
        });
    }

    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);

    reloadbutton.addEventListener('click', function(ev){
        $('#canvas').hide();
        $('#video').show();
        $('#startbutton').show();
        $('#reloadbutton').hide();
        $('#savebutton').hide();
        ev.preventDefault();
    }, false);

    savebutton.addEventListener('click', function(ev){
        savePicture();
        ev.preventDefault();
    }, false);
}


$(function(){
   activeCamera(); 
});