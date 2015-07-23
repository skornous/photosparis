<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '<?php echo APPID; ?>',
            xfbml      : true,
            version    : 'v2.3'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<?php
use Facebook\FacebookRequest;
use Facebook\GraphUser;

if($session){
    $_SESSION['fb_token'] = (string) $session->getAccessToken();

    // N.B. : The 3 next statements can be executed on one line instead of 3
    $request_user = new FacebookRequest($session, "GET", "/me");
    $request_user_execute = $request_user->execute();
    $user = $request_user_execute->getGraphObject(GraphUser::className());
    // for a user's photos : /me/photos/uploaded and then getGraphObject(...)->AsArray()

    $loginUrl = fb_goto('grid');
//		var_dump($user);

} else {
    $loginUrl = $helper->getLoginUrl($neededRights);
}
?>
    <div class="center-align">
    <img src="<?php echo fb_img('apn.png'); ?>" alt="logo" />
    <p>
        Bienvenue sur l'application de concours Photos Paris.
    </p>
    </div>
    <div class="center-align">
        <br/><br/>

        <br/><br/><a class="waves-effect waves-light btn-large participe green accent-4 white-text" href="<?php echo $loginUrl; ?>">JE PARTICIPE</a>
<!--        <a class="waves-effect waves-light btn-large vote light-blue accent-4 white-text" href="--><?php //echo fb_goto('vote'); ?><!--">JE VEUX JUSTE VOTER</a>-->
    </div>
