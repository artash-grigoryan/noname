<!doctype html>
<html lang="fr">

    <head>
        <script src="//connect.facebook.net/fr_FR/all.js"></script>
    </head>
    <body>

        <div id="fb-root"></div>
        <script>
            
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '<?=$this->_fbAppId?>', // App ID
                    channelUrl : '<?=PATH?>', // Channel File
                    status     : true, // check login status
                    cookie     : true, // enable cookies to allow the server to access the session
                    xfbml      : true  // parse XFBML
                });
                
                // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
                // for any authentication related change, such as login, logout or session refresh. This means that
                // whenever someone who was previously logged out tries to log in again, the correct case below 
                // will be handled. 
                FB.Event.subscribe('auth.authResponseChange', function(response) {
                    // Here we specify what we do with the response anytime this event occurs. 
                    if (response.status === 'connected') {
                    // The response object is returned with a status field that lets the app know the current
                    // login status of the person. In this case, we're handling the situation where they 
                    // have logged in to the app.
                    
                    FB.logout(function(response) {
                    // user is now logged out
                        document.location.href='<?=$this->_redirect_uri?>';
                    });
                    }
                });
            };

            // Load the SDK asynchronously
            (function(d){
                var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement('script'); js.id = id; js.async = true;
                js.src = "//connect.facebook.net/fr_FR/all.js";
                ref.parentNode.insertBefore(js, ref);
            }(document));

            
        </script>

        <!--
        Below we include the Login Button social plugin. This button uses the JavaScript SDK to
        present a graphical Login button that triggers the FB.login() function when clicked.

        Learn more about options for the login button plugin:
        /docs/reference/plugins/login/ -->

    </body>
</html>