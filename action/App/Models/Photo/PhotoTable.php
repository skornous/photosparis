<?php

	namespace App\Models\Photo;


	use App\Models\Model;

	class PhotoTable extends Model {


		function __construct() {

			parent::__construct();
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

		public function getAllPhotos(){
			$sql = "SELECT id, fb_id
					FROM photosparis.photos as p
						INNER JOIN photosparis.user_photos as up
						ON p.id = up.photo_id
					WHERE removed = false;";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute();
			if ($state) {
				return $rq->fetchAll(\PDO::FETCH_ASSOC);
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

		public function getRandom() {

			$sql = "SELECT fb_id
					FROM photosparis.photos
					ORDER BY RANDOM() LIMIT 1";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute();

			if ($state) {
				$dbUserPhotos = $rq->fetch(\PDO::FETCH_ASSOC);
				if($dbUserPhotos)
					return $dbUserPhotos['fb_id'];
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

		public function getNbLikes($photo_id = null) {
			if (is_null($photo_id)) {
				return false;
			}

			$sql = "SELECT
						count(p.id) as likes
					FROM
						photosparis.photos as p
						INNER JOIN photosparis.likes as l
							ON p.id = l.photo_id
					WHERE
						p.id = :photo_id
						AND removed = false;";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				"photo_id" => $photo_id,
			]);

			if ($state) {
				$dbLikes = $rq->fetch(\PDO::FETCH_ASSOC);
				return (empty($dbLikes['likes'])) ? 0 : $dbLikes['likes'];
			} else {
				return false;
			}
		}

	}