<?php
    $page = ($_GET && $_GET['page']) ? $_GET['page'] : 'home';


function fb_goto($page){
    return "index.php?page=".$page;
}

function fb_img($img){
    return "img/".$img;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ma Page</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/justifiedGallery.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

    <body class="grey lighten-1">

        <div id="main" class="grey lighten-4">
        <?php
            if($page != 'home')
                include('pages/menu.php');
            include('pages/'.$page.'.php');
        ?>
        </div>
        <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
		<script src="js/materialize.min.js" type="text/javascript"></script>
		<script src="js/jquery.justifiedGallery.min.js" type="text/javascript"></script>
		<script src="js/script.js" type="text/javascript"></script>
	</body>
</html>