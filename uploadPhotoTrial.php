<?php
	$title = "Test upload photo";
	$neededRights = array("user_photos", "publish_actions");
	$pageURL = "uploadPhotoTrial.php";
	require("template/header.php");

	require("facebook-php-sdk-v4-4.0-dev/autoload.php");
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	use Facebook\FacebookRequestException;

	if ($session) {
?>
<h1>Upload a photo</h1>
	<form enctype="multipart/form-data" action="uploadPhotoTrial.php" method="post" class="col s12">
		<label for="com">Comment your picture</label>
		<textarea id="com" name="com"></textarea>
		<br/>
		<label for="file">Pic</label>
		<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
		<input type="file" name="file" />
		<br/>
		<input class="btn" name="submit" type="submit" value="Upload File">
	</form>
</div>
<?php
//		var_dump($_FILES);
		if (isset($_FILES["file"]) && !empty($_FILES["file"])) {
			$localFile = $_FILES["file"]["tmp_name"];
			$curlFile = new CURLFile($localFile, $_FILES["file"]["type"]);
			$comment = $_POST["com"];
//			var_dump($curlFile, $comment);
			try {
				$response = (new FacebookRequest(
					$session, 'POST', '/me/photos', array(
						'source' => $curlFile,
//					'url' => "https://photosparis.herokuapp.com/img/penguin.jpg",
						'message' => $comment
					)
				))->execute()->getGraphObject();
//				var_dump($response);
//				unlink($localFile);
			} catch (FacebookRequestException $fre) {
				echo "Exception occured, code: " . $fre->getCode();
				echo " with message: " . $fre->getMessage();
			}
		} else if (isset($_FILES["file"]) && empty($_FILES["file"])){
			echo "No file selected ";
		}
	}
?>


<?php require("template/footer.php"); ?>