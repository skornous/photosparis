<?php

namespace App\Controllers;


use App\Models\Photo\Photo;
use App\Models\User\User;

class PhotoController extends Controller {

	public function __construct($id = null) {
		parent::__construct();
		$this->loadModel("Photo");
		$this->loadModel("User");
	}

	public function voteFor($id = null, $user = null) {
		if (is_null($id) || is_null($user)) { return false; }

		$newVote = $this->Models["Photo"]->voteForUsingId($id, $user);

		if ($newVote !== false) {
			echo "Vote success";
		}
	}

	public function add($id = null, $user = null) {
		if (is_null($id) || is_null($user)) { return false; }

		// transform user fb id into a user
		$dbUser = $this->Models["User"]->getUserByFbId($user);

		if ($dbUser !== false) {
			$dbUser = User::createFromArray($dbUser);
			// verify user
			if (!$this->Models["User"]->userExists($dbUser->getId())) {
				echo "Nice try<br>";
				return false;
			}

			// verify photo doesn't already exists for the given user
			$linkExists = $this->Models["User"]->alreadyHaveFBPhoto($dbUser->getId(), $id);

			if($linkExists !== true) {
				// add photo
				$addedPhoto = $this->Models["Photo"]->add(Photo::createFromArray([
					"id" => 0,
					"fb_id" => $id,
					"removed" => false,
				]));

				// link the photo to the user
				if ($addedPhoto !== false) {
					echo "Photo added as $addedPhoto<br>";
					$linkUp = $this->Models["User"]->addPhotoLink($dbUser->getId(), $addedPhoto);

					if ($linkUp !== false) {
						echo "Photo $id (or $addedPhoto in DB) linked to user $user (" . $dbUser->getId() . " in DB)<br>";
					} else {
						echo "Link to photo failed<br>";
					}

				} else {
					echo "Photo not added<br>";
				}
			} else {
				echo "User already have this photo";
				return false;
			}
		}
	}
}