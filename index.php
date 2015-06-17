<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Page d'accueil</title>
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
		body {
			background-color: #e9eaed;
		}
		#iframe-container {
			border: 1px solid #c4cde0;
			border-radius: 3px;
			background-color: #fff;
			width: 851px;
		}
		#iframe-paddinger {
			padding: 20px 20px;
		}
		iframe {
			height: 800px;
			margin: 0 auto;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="col s2">
			Liste des tests :
			<ul>
				<li><a href="?iframe=index_home.html">Index accueil</a></li>
				<li><a href="?iframe=index_grille.html">Index grille</a></li>
				<li><a href="?iframe=index_menu.html">Index menu</a></li>
				<li><a href="?iframe=index_vote.html">Index vote</a></li>
			</ul>
			<hr/>
			Taille :
			<ul id="links">
				<li><a href="#" data-size="520">Onglet standard</a></li>
				<li><a href="#" data-size="810">Onglet large</a></li>
			</ul>
		</div>
		<div class="col s10">
			Rendu dans un iframe :<br>
			<div id="iframe-container">
				<div id="iframe-paddinger">
					<iframe width="810" id="iframe" src="<?php if (!empty($_GET['iframe'])) echo $_GET["iframe"]; ?>" frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
	<script src="js/materialize.min.js" type="text/javascript"></script>
	<!--<script src="js/script.js" type="text/javascript"></script>-->
	<script>
		$(function () {
			$("#links a").click(function (e) {
				e.preventDefault();
				$("#iframe").attr("width", $(this).data("size"));
				$("#iframe-container").css("width", ($(this).data("size")+40) + "px");
			})
		})
	</script>
</body>
</html>