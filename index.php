<?php
	$title = "Page d'accueil";
	$neededRights = array();
	$pageURL = "index.php";
	require("template/header.php");
	use Facebook\FacebookRedirectLoginHelper;
?>
	<h1>Bonjour</h1>
	Liste des tests :
	<ul>
		<li><a href="uploadPhotoTrial.php">Test upload photo</a></li>
		<?php
			$helper = new FacebookRedirectLoginHelper(SITE_URL . "uploadPhotoWithPermissions.php");
			$loginUrl = $helper->getLoginUrl(array("publish_actions"));
			echo "<a href=" . $loginUrl . ">Test upload photo with permissions</a><br>";
		?>
		<?php
			$helper = new FacebookRedirectLoginHelper(SITE_URL . "uploadPhotoWithAlbum.php");
			$loginUrl = $helper->getLoginUrl(array("user_photos","publish_actions"));
			echo "<a href=" . $loginUrl . ">Test upload photo with album</a><br>";
		?>
		<li><a href="materializeTooltip.php">Test materialize tooltip</a></li>
		<li><a href="voteTrial.php">Test like photo</a></li>
	</ul>
<?php
	require("template/footer.php");
?>