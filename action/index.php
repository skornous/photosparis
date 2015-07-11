<?php

	namespace Action;
	use Action\Router\Router;

	require('autoloader.php');
	Autoloader::register();

	var_dump($_GET);

	$router = new Router($_GET['url']);
	$router->get('/', function($id){ echo "Bienvenue sur ma homepage !"; });
	$router->run();