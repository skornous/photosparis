<?php
	$title = "Test vote for photo";
	$neededRights = array();
	$pageURL = "voteTrial.php";
	require("template/header.php");

	require("facebook-php-sdk-v4-4.0-dev/autoload.php");
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	use Facebook\FacebookRequestException;

	if ($session) {
		?>
<h1>Vote for a photo</h1>
	<div class="fb-like"
		data-href="https://photosparis.herokuapp.com/action/like_photo/10205740993142J215"
		data-layout="button_count"
		data-action="like"
		data-show-faces="false"
		data-share="false"
		data-fbid="10205740993142J215"></div>
</div>
<?php }
	$scriptsUrls = array("vote");
	require("template/footer.php"); ?>