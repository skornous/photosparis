<?php
	$title = "Test upload photo with permissions";
	$neededRights = array("user_photos", "publish_actions");
	$pageURL = "uploadPhotoWithPermissions.php";
	require("template/header.php");

	require("facebook-php-sdk-v4-4.0-dev/autoload.php");
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	use Facebook\FacebookRequestException;

	if ($session) {
		$_SESSION['fb_token'] = (string) $session->getAccessToken();

		// N.B. : The 3 next statements can be executed on one line instead of 3
		$request_user_permissions = new FacebookRequest($session, "GET", "/me/permissions");
		$request_user_permissions_execute = $request_user_permissions->execute();
		$user_permissions = $request_user_permissions_execute->getGraphObject()->asArray();

		$asPublicActionPermission = false;
		foreach($user_permissions as $permission) {
			if ($permission->permission === "publish_actions" && $permission->status === "granted") {
				$asPublicActionPermission = true;
			}
		}
		if ($asPublicActionPermission) {


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
			// upload the photo
			if (isset($_FILES["file"]) && !empty($_FILES["file"])) { // the photo need to be given
				$localFile = $_FILES["file"]["tmp_name"];
				// create the CURLFile using the file type
				$curlFile = new CURLFile($localFile, $_FILES["file"]["type"]);
				$comment = $_POST["com"];
				try {
					// send the file to facebook
					$response = (new FacebookRequest(
						$session, 'POST', '/me/photos', array(
							'source' => $curlFile,
	//					'url' => "https://photosparis.herokuapp.com/img/penguin.jpg",
							'message' => $comment // empty by default
						)
					))->execute()->getGraphObject();
				} catch (FacebookRequestException $fre) {
					echo "Facebook encountered an error during the file upload";
//					echo "Exception occured, code: " . $fre->getCode();
//					echo " with message: " . $fre->getMessage();
				}
			} else if (isset($_FILES["file"]) && empty($_FILES["file"])){
				echo "No file selected ";
			}
		} else {
			echo "You did not gave the app the right to upload photos<br>";
			$loginUrl = $helper->getLoginUrl($neededRights);
			echo "<a href=" . $loginUrl . ">Add the rights</a><br>";
			echo "<a href='/photosparis/'>Back to votes</a>";
		}
	}
?>


<?php require("template/footer.php"); ?>