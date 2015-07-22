<?php

	namespace Action;

	use Action\Router\Router;
	use Action\Router\RouterException;

	require('autoloader.php');
	Autoloader::register();

	$router = new Router($_GET['url']);

	try {
		// -- User's actions -- //

//		add user
//		vote
//		retrieve vote
//		get photo list (pagination)
//		get one particular photo
//		add photo
//		delete photo
//		get user's photo

		// -- Admin's actions -- //

//		edit params
//		validate photo
//		remove photo
//		get winner(s) primary email
//		get the list of the unvalidated photos
//		ban a user
//		close an event

		$router->get('/like_photo/:id/:user', "Photo#voteFor")->with("id", "[0-9A-Za-z]+")->with("user", "[0-9A-Za-z]+");
		$router->get('/post_photo/:id/:user', "Photo#add")->with("id", "[0-9A-Za-z]+")->with("user", "[0-9A-Za-z]+");

		$router->get('/', function () {

			echo json_encode(["code" => 1, "msg" => "nothing here"]);
		});

		$router->run();
	} catch (RouterException $re) {
		echo $re->getMessage();
	}
