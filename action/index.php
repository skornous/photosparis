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
//DONE		get photo list (pagination) -- PHOTO
//DONE		get one particular photo -- PHOTO
//DONE		add photo -- PHOTO
//--ABORT		delete photo -- PHOTO
//DONE		get user's photo -- PHOTO
//DONE		get random photo -- PHOTO
//DONE		get nb of likes on a photo -- PHOTOA


		// -- Admin's actions -- //

//--ABORT		edit params -- EVENT
//--ABORT		validate photo -- PHOTO (?)
//--ABORT		remove photo -- PHOTO
//--ABORT		get winner(s) primary email -- USER ---> order by get photo list
//--ABORT		get the list of the unvalidated photos (?)
//DONE		ban a user -- USER
//--ABORT		close an event -- EVENT

		$router->get('/get_photos', "Photo#getAll");
		$router->get('/get_photo/:id', "Photo#get")->with("id", "[0-9A-Za-z]+");
		$router->get('/get_photo_by_user/:id', "Photo#getByUser")->with("id", "[0-9A-Za-z]+");
		$router->get('/get_photo_likes/:id', "Photo#likes")->with("id", "[0-9A-Za-z]+");
		$router->get('/get_photo_random', "Photo#getRandom");
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
