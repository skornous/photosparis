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
//DONE		vote -- USER +PHOTO
//DONE		remove vote -- USER +PHOTO
//TODO		get photo list (pagination) -- PHOTO
//DONE		get one particular photo -- PHOTO
//DONE		add photo -- PHOTO
//TODO		delete photo -- PHOTO
//DONE		get user's photo -- PHOTO
//TODO		get random photo the user doesn't like -- PHOTO
//TODO		get nb of likes on a photo


		// -- Admin's actions -- //

//TODO		edit params -- EVENT
//TODO		validate photo -- PHOTO (?)
//TODO		remove photo -- PHOTO
//TODO		get winner(s) primary email -- USER
//TODO		get the list of the unvalidated photos (?)
//DONE		ban a user -- USER
//TODO		close an event -- EVENT

		$router->get('/get_photo/:id', "Photo#get")->with("id", "[0-9A-Za-z]+");
		$router->get('/get_photo_by_user/:id', "Photo#getByUser")->with("id", "[0-9A-Za-z]+");
		$router->get('/', function () { echo json_encode(["code" => 1, "msg" => "nothing here"]); });

		$router->post('/post_user', "User#add");
		$router->post('/like_photo', "User#voteFor");
		$router->post('/post_photo', "Photo#add");
		$router->post('/post_event', "Event#add");
		$router->post('/', function () { echo json_encode(['code' => 1, 'msg' => 'nothing here']); });

		$router->patch('/patch_user', "User#patch");
		$router->patch('/', function () { echo json_encode(['code' => 1, 'msg' => 'nothing here']); });


		$router->run();
	} catch (RouterException $re) {
		echo $re->getMessage();
	}
