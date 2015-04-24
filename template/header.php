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
<a href="index.php">Back home</a>