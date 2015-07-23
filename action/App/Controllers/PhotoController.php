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

		public function get($id = null) {

			if (is_null($id)) {
				return false;
			}

			$dbPhoto = $this->Models["Photo"]->getPhotoByFbId($id);

			if ($dbPhoto) {
				var_dump($dbPhoto);
			} else {
				echo "Photo does not exist";
			}
		}

		public function getAll(){

			$dbPhotos = $this->Models["Photo"]->getAllPhotos();

			if($dbPhotos){
				var_dump($dbPhotos);
			} else {
				echo "No photos to display";
			}
		}

		public function getByUser($user_id = null) {

			if (is_null($user_id)) {
				return false;
			}

			$dbUser = $this->Models["User"]->getUserByFbId($user_id);

			if ($dbUser) {
				$dbUser = User::createFromArray($dbUser);
				$photo_id = $this->Models["Photo"]->getPhotoIdByUserId($dbUser->getId());

				if ($photo_id) {
					$photo_id = $this->Models["Photo"]->get($photo_id);

					if ($photo_id) {
						var_dump($photo_id);
					} else {
						echo "I'm a teapot";
					}

				} else {
					echo "This user doesn't have any photos";
				}
			} else {
				echo "User does not exist";
			}
		}

		public function getRandom() {

			$photoRandom = $this->Models["Photo"]->getRandom();

			if($photoRandom){
				echo json_encode(['photo' => $photoRandom]);
			}else{
				echo "No random photos today";
			}
		}

		public function add() {

			$photo = (isset($_POST['photo'])) ? $_POST['photo'] : null;
			$user = (isset($_POST['user'])) ? $_POST['user'] : null;

			if (is_null($photo) || is_null($user)) {
				echo "Param missing";

				return false;
			}

			// transform user fb id into a user
			$dbUser = $this->Models["User"]->getUserByFbId($user);

			if ($dbUser !== false) {
				$dbUser = User::createFromArray($dbUser);


				// verify if a photo already exists for the given user
				$old_photo_id = $this->Models["Photo"]->getPhotoIdByUserId($dbUser->getId());

				if ($old_photo_id) {
					// verify if the user already has this photo
					$old_fb_id = $this->Models["Photo"]->getFbIdByPhotoId($old_photo_id);
					if ($old_fb_id === $photo) {
						echo "User already has this photo";

						return false;
					}

					$dbPhoto = $this->Models["Photo"]->get($old_photo_id);
					if ($dbPhoto !== false) {
						$dbPhoto = $this->Models["Photo"]->remove($old_photo_id, $dbUser->getId());
						if ($dbPhoto) {
							echo "Old photo has been removed (fb id : $old_fb_id )<br>";
						} else {
							echo "Photo removal has failed<br>";

							return false;
						}
					} else {
						echo "I'm a teapot";

						return false;
					}

				}

				// verify if photo already exists
				$dbPhoto = $this->Models["Photo"]->getPhotoByFbId($photo);

				if ($dbPhoto) {
					// verify if photo is already linked to user and removed
					$dbPhoto = Photo::createFromArray($dbPhoto);
					$removedDbPhoto = $this->Models["Photo"]->getPhotoUserRemoved($dbUser->getId(), $dbPhoto->getId());
//var_dump($removedDbPhoto);
					if ($removedDbPhoto) {
						echo "Photo already exists and is linked to user.<br>";
						$removedDbPhoto = $this->Models["Photo"]->remove($dbPhoto->getId(), $dbUser->getId(), false);
						if ($removedDbPhoto) {
							echo "Photo has been reactivated";

							return $removedDbPhoto;
						} else {
							echo "Reactivation has failed";

							return false;
						}
					}
				}

				// add photo
				$addedPhoto = $this->Models["Photo"]->add(Photo::createFromArray([
					                                                                 "id"    => 0,
					                                                                 "fb_id" => $photo,
				                                                                 ]));

				// link the photo to the user
				if ($addedPhoto !== false) {
					echo "Photo added as $addedPhoto<br>";
					$linkUp = $this->Models["User"]->addPhotoLink($dbUser->getId(), $addedPhoto);

					if ($linkUp !== false) {
						echo "Photo $photo (or $addedPhoto in DB) linked to user $user (" . $dbUser->getId() . " in DB)<br>";
					} else {
						echo "Link to photo failed<br>";
					}

				} else {
					echo "Photo not added<br>";
				}
			} else {
				echo "User does not exist";
			}
		}

		public function likes($id) {
			if (is_null($id)) {	echo "Param missing"; return false; }

			// verify if photo already exists
			$dbPhoto = $this->Models["Photo"]->getPhotoByFbId($id);
			if ($dbPhoto) {
				// verify if photo is already linked to user and removed
				$dbPhoto = Photo::createFromArray($dbPhoto);

				$likes = $this->Models['Photo']->getNbLikes($dbPhoto->getId());
				if ($likes !== false) {
					echo json_encode(["likes" => $likes]);
				} else {
					echo "An error occured";
				}
			} else {
				echo "Photo not in DB";
			}
		}
	}