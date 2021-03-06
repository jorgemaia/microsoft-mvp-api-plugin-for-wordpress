<?php
function msmvpapi_msoauthscript ( ) {
    // https://github.com/AzureAD/microsoft-authentication-library-for-js
?>
<script src="https://secure.aadcdn.microsoftonline-p.com/lib/0.1.1/js/msal.min.js"></script>
<script class="pre">
    var userAgentApplication = new Msal.UserAgentApplication('<?php echo get_option( 'msmvpapi_options' ) [ 'client_id' ]; ?>', null, function (errorDes, token, error, tokenType) {
            // this callback is called after loginRedirect OR acquireTokenRedirect (not used for loginPopup/aquireTokenPopup)
    });
function login () {
    userAgentApplication.loginPopup(["user.read"]).then( function(token) {        
        var user = userAgentApplication.getUser();
        document.getElementById('msmvpapi_token').value = token;
        document.getElementById('submit').click();
        // signin successful
    }, function (error) {
        // handle error
        console.log('Error', error);
    });
}
function renewToken () {
    var user = userAgentApplication.getUser();
    console.log('Renewing token...');
    userAgentApplication.acquireTokenSilent(['user.read'], null, user).then( function(token) {
        console.log('New token', token);
        document.getElementById('msmvpapi_token').value = token;
        document.getElementById('submit').click();
    }, function (error) {
        console.log('Error', error);
    });
}

function logout () {
    var user = userAgentApplication.getUser();
    console.log('Renewing token...');
    userAgentApplication.logout().then(function () {
        document.getElementById('msmvpapi_token').value = '';
        document.getElementById('submit').click();
    }, function(error){
        console.log('Error', error);
    });
}
</script>
<?php    
}
?>