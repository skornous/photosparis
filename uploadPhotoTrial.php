<?php
	$title = "Test upload photo";
	require("template/header.php");

	require("facebook-php-sdk-v4-4.0-dev/autoload.php");
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	use Facebook\FacebookRequestException;
?>
<h1>Upload a photo</h1>
<?php
	if ($session) {
		try {
			$response = (new FacebookRequest(
				$session, 'POST', '/me/photos', array(
					'url' => "https://photosparis.herokuapp.com/img/penguin.jpg",
					'message' => 'User provided message'
				)
			))->execute()->getGraphObject();
			var_dump($response);
		} catch (FacebookRequestException $fre) {
			echo "Exception occured, code: " . $fre->getCode();
			echo " with message: " . $fre->getMessage();
		}
	}
?>


<?php require("template/footer.php"); ?>