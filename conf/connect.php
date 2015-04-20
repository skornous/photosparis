<?php
	error_reporting(E_ALL);
	ini_set("display_error", 1);

	session_start();
	require("conf/fb_credentials.php");
	require("facebook-php-sdk-v4-4.0-dev/autoload.php");

	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookSession;
	use Facebook\GraphUser;

	FacebookSession::setDefaultApplication(APPID, APPSECRET);

	$helper = new FacebookRedirectLoginHelper("https://photosparis.herokuapp.com/");

	// If var session exists && $_SESSION['fb_token'] exists -> create user from fb session
	if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
		$session = new FacebookSession($_SESSION['fb_token']);
	} else { // else print connexion's link
		$session = $helper->getSessionFromRedirect();
	}

	if($session){
		$_SESSION['fb_token'] = (string) $session->getAccessToken();

		// N.B. : The 3 next statements can be executed on one line instead of 3
		$request_user = new FacebookRequest($session, "GET", "/me");
		$request_user_execute = $request_user->execute();
		$user = $request_user_execute->getGraphObject(GraphUser::className());
		// for a user's photos : /me/photos/uploaded and then getGraphObject(...)->AsArray()

		echo "Bonjour " . $user->getName();
//		var_dump($user);

	} else {
		$loginUrl = $helper->getLoginUrl(array("user_photos", "publish_actions"));
		echo "<a href=" . $loginUrl . ">Connect with Facebook</a>";
	}
