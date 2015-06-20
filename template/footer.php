<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="libs/jquery/jquery.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="libs/materialize/js/materialize.min.js"></script>
<?php
	if (isset($scripts)) {
		foreach($scripts as $script) {
			echo "<script>" . $script . "</script>";
		}
	}
	if (isset($scriptsUrls)) {
		foreach($scriptsUrls as $script) {
			echo "<script src='js/" . $script . ".js'></script>";
		}
	}
?>
</body>
</html>