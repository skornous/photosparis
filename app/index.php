<?php

$neededRights = array();
$pageURL = "index.php";
require("conf/connect.php");

    $page = ($_GET && isset($_GET['page'])) ? $_GET['page'] : 'home';

if(!$_SESSION){
    if($page != 'home'){
        header('Location : '.fb_goto('home'));
    }
}else{
    if($page == 'home'){
        header('Location : '.fb_goto('grid'));
    }
}
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
    <title>Photos Paris</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/justifiedGallery.min.css">
    <link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">


</head>

    <body class="grey lighten-1">

        <?php
            if($page != 'home')
                include('pages/menu.php');
            include('pages/'.$page.'.php');
        ?>
        <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
		<script src="js/materialize.min.js" type="text/javascript"></script>
		<script src="js/jquery.justifiedGallery.min.js" type="text/javascript"></script>
		<script src="js/lightbox.min.js" type="text/javascript"></script>
		<script src="js/script.js" type="text/javascript"></script>
	</body>
</html>