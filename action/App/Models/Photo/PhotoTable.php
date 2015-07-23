<?php

	namespace App\Models\Photo;


	use App\Models\Model;

	class PhotoTable extends Model {


		function __construct() {

			parent::__construct();
		}

		public function voteForUsingId($id = null, $user = null) {

			if (is_null($id) || is_null($user)) {
				return false;
			}

			$sql = "INSERT INTO photosparis.likes(photo_id, user_id) VALUES (:photo, :user);";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				                      "photo" => $id,
				                      "user"  => $user,
			                      ]);

			if ($state) {
				return true;
			} else {
				return false;
			}
		}

		// get photo by id
		public function get($id = null) {
			if (is_null($id)) { return false; }


			$sql = "SELECT id, fb_id FROM photosparis.photos WHERE id = :id;";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				"id" => $id,
			]);

			if ($state) {
				return $rq->fetch(\PDO::FETCH_ASSOC);
			} else {
				return false;
			}
		}

		public function getPhotoByFbId($fb_id = null) {
			if (is_null($fb_id)) { return false; }

			$sql = "SELECT id, fb_id FROM photosparis.photos WHERE fb_id = :fb;";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				"fb" => $fb_id,
			]);

			if ($state) {
				return $rq->fetch(\PDO::FETCH_ASSOC);
			} else {
				return false;
			}
		}
		public function getFbIdByPhotoId($photo_id = null) {
			if (is_null($photo_id)) { return false; }

			$sql = "SELECT id, fb_id FROM photosparis.photos WHERE id = :id;";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				"id" => $photo_id,
			]);

			if ($state) {
				$dbPhoto =  $rq->fetch(\PDO::FETCH_ASSOC);
				return $dbPhoto['fb_id'];
			} else {
				return false;
			}
		}

		public function getPhotoIdByUserId($user_id = null) {
			if (is_null($user_id)) { return false; }

			$sql = "SELECT user_id, photo_id FROM photosparis.user_photos WHERE user_id = :user_id AND removed = false; ";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				"user_id" => $user_id,
			]);

			if ($state) {
				$dbUserPhotos = $rq->fetch(\PDO::FETCH_ASSOC);
				if($dbUserPhotos)
					return $dbUserPhotos['photo_id'];
				else
					return false;
			} else {
				return false;
			}
		}

		public function getPhotoUserRemoved($user_id = null,$photo_id = null) {
			if (is_null($user_id)||is_null($user_id)) { return false; }

			$sql = "SELECT user_id, photo_id FROM photosparis.user_photos WHERE user_id = :user_id AND photo_id = :photo_id AND removed = true; ";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				"user_id" => $user_id,
				"photo_id" => $photo_id,
			]);

			if ($state) {
				return $rq->fetch(\PDO::FETCH_ASSOC);
			} else {
				return false;
			}
		}

		public function add($photo = null) {

			if (is_null($photo)) {
				return false;
			}

			$sql = "INSERT INTO photosparis.photos(fb_id) VALUES (:fb_id);";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				                      "fb_id" => $photo->getFbId(),
			                      ]);

			if ($state) {
				//TODO change it for "photosparis.photos_id_seq" before using on heroku
				return $this->db->lastInsertId('photosparis.photos_id_seq1');
			} else {
				return false;
			}
		}

		public function remove($photo_id = null, $user_id = null, $remove = true) {

			if (is_null($photo_id) || is_null($user_id)) {
				return false;
			}
			$sql = "UPDATE photosparis.user_photos SET removed = :removed WHERE user_id = :user_id AND photo_id = :photo_id;";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				"removed" => ($remove) ? 1 : 0,
				"user_id" => $user_id,
				"photo_id" => $photo_id,
			]);
			if ($state) {
				return $photo_id;
			} else {
				return false;
			}
		}

		public function getNbLikes($photo_id = null){
			if (is_null($photo_id)) {
				return false;
			}

			$sql = "SELECT count(p.photo_id) as likes FROM photosparis.photos as p, photosparis.likes as l
					WHERE p.photo_id = l.photo_id AND p.photo_id = :photo_id AND removed = false; ";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				"photo_id" => $photo_id,
			]);

			if ($state) {
				$dbLikes = $rq->fetch(\PDO::FETCH_ASSOC);
				return $dbLikes['likes'];
			} else {
				return false;
			}
		}

	}