<?php

	namespace Action;

	use Action\Router\Router;
	use Action\Router\RouterException;

	require('autoloader.php');
	Autoloader::register();

	$router = new Router($_GET['url']);

	try {
		// -- User's actions -- //

//DONE		add user -- USER
//TODO		vote -- USER +PHOTO
//TODO		retrieve vote -- USER +PHOTO
//TODO		get photo list (pagination) -- PHOTO
//DONE		get one particular photo -- PHOTO
//DONE		add photo -- PHOTO
//TODO		delete photo -- PHOTO
//TODO		get user's photo -- PHOTO
//TODO		get random photo the user doesn't like -- PHOTO


		// -- Admin's actions -- //

//TODO		edit params -- EVENT
//TODO		validate photo -- PHOTO (?)
//TODO		remove photo -- PHOTO
//TODO		get winner(s) primary email -- USER
//TODO		get the list of the unvalidated photos (?)
//DONE		ban a user -- USER
//TODO		close an event -- EVENT

		$router->get('/like_photo/:id/:user', "Photo#voteFor")->with("id", "[0-9A-Za-z]+")->with("user", "[0-9A-Za-z]+");
		$router->get('/get_photo/:id', "Photo#get")->with("id", "[0-9A-Za-z]+");
		$router->get('/get_photo_by_user/:id', "Photo#getByUser")->with("id", "[0-9A-Za-z]+");
//		$router->get('/post_photo/:id/:user', "Photo#add")->with("id", "[0-9A-Za-z]+")->with("user", "[0-9A-Za-z]+");
		$router->post('/post_photo', "Photo#add");
		$router->post('/post_user', "User#add");
		$router->post('/post_event', "Event#add");

		$router->patch('/patch_user', "User#patch");

		$router->get('/', function () {

			echo json_encode(["code" => 1, "msg" => "nothing here"]);
		});

		$router->run();
	} catch (RouterException $re) {
		echo $re->getMessage();
	}
