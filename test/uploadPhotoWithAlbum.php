<?php
	$title = "Test upload photo with album";
	$neededRights = array("user_photos","publish_actions");
	$pageURL = "uploadPhotoWithAlbum.php";
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

		$hasPublicActionPermission = false;
		$hasUserPhotosPermission = false;
		foreach($user_permissions as $permission) {
			if ($permission->permission === "publish_actions" && $permission->status === "granted") {
				$hasPublicActionPermission = true;
			}
			if ($permission->permission === "user_photos" && $permission->status === "granted") {
				$hasUserPhotosPermission = true;
			}
		}
		if ($hasPublicActionPermission && $hasUserPhotosPermission) {

			// get the albums from facebook
			$albums = (new FacebookRequest($session, 'GET', '/me/albums'))->execute()->getGraphObject()->asArray();
			?>
<h1>Upload a photo</h1>
<div class="container">
	<form enctype="multipart/form-data" method="post" class="col s12">
		<div class="input-filed">
			<textarea id="com" name="com"></textarea>
			<label for="com">Comment your picture</label>
		</div>

		<div class="input-filed">
			<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
			<input type="file" name="file" />
			<label for="file">Pic</label>
		</div>

		<div class="input-filed">
	      <input name="withAlbum" type="checkbox" id="withAlbum" onchange="withAlbumChanged(this);" />
	      <label for="withAlbum">Add the photo to an existing album</label>
	    </div>

		<div class="input-field">
			<select id="albums" name="album" style="display: none;">
			<option value="0" disabled selected>Select your album</option>
				<?php foreach($albums["data"] as $album): ?>
					<option value="<?php echo $album->id;?>"><?php echo $album->name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="input-field">
			<input class="btn" name="submit" type="submit" value="Upload File">
		</div>
	</form>
<?php
			// upload the photo
			if (isset($_FILES["file"]) && !empty($_FILES["file"])) { // the photo need to be given
				$localFile = $_FILES["file"]["tmp_name"];
				// create the CURLFile using the file type
				$curlFile = new CURLFile($localFile, $_FILES["file"]["type"]);
				$comment = $_POST["com"];
				try {

					if (isset($_POST["withAlbum"]) && $_POST["withAlbum"] === "on" && isset($_POST["album"]) && intval($_POST["album"]) !== 0) {
						$albumID = $_POST["album"];
					} else {
						$albumID = "me";
					}
					// send the file to facebook
					$response = (new FacebookRequest(
						$session, 'POST', '/' . $albumID . '/photos', array(
							'source' => $curlFile,
							// 'url' => "https://photosparis.herokuapp.com/img/penguin.jpg",
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
			$loginUrl = $helper->getReRequestUrl($neededRights);
			echo "<a href=" . $loginUrl . ">Add the rights</a><br>";
			echo "<a href='/photosparis/'>Back to votes</a>";
		}
	}
?>
</div>
<script type="application/javascript">
	function withAlbumChanged(input) {
		if (input.checked) {
			$("#albums").show();
		} else {
			$("#albums").hide();
		}
	}
</script>
<?php require("template/footer.php"); ?>


