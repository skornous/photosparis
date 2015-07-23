<?php
	const SITE_URL = "https://photosparis.herokuapp.com/";
	error_reporting(E_ALL);
	ini_set("display_error", 1);

	session_start();
	require("facebook-php-sdk-v4-4.0-dev/autoload.php");

	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookSession;

	if (file_exists("conf/fb_credentials.php")){
		require("conf/fb_credentials.php");
		FacebookSession::setDefaultApplication(APPID, APPSECRET);
	}



	$helper = new FacebookRedirectLoginHelper(SITE_URL . $pageURL);

	// If var session exists && $_SESSION['fb_token'] exists -> create user from fb session
	if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
		$session = new FacebookSession($_SESSION['fb_token']);
	} else { // else print connexion's link
		$session = $helper->getSessionFromRedirect();
	}
