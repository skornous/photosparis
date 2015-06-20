<?php
	error_reporting(E_ALL);
	ini_set("display_error", 1);

	require("conf/connect.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="libs/materialize/css/materialize.min.css">
</head>
<body>
<div id="fb-root"></div>
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

		echo "Bonjour " . $user->getName() . "<br>";
//		var_dump($user);

	} else {
		$loginUrl = $helper->getLoginUrl($neededRights);
		echo "<a href=" . $loginUrl . ">Connect with Facebook</a><br>";
	}
?>
<a href="index.php">Back home</a>