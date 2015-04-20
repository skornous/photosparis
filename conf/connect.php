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
