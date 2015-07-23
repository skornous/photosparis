<?php

	namespace App\Models\User;


	use App\Models\Model;
	use \PDO;

	class UserTable extends Model {


		function __construct() {

			parent::__construct();
		}

		public function userExists($userID = null) {

			if (is_null($userID)) {
				return false;
			}

			$sql = "SELECT id, banned FROM photosparis.users WHERE id = :userID;";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				                      "userID" => $userID,
			                      ]);

			if ($state) {
				$user = $rq->fetch(PDO::FETCH_ASSOC);

				return ($user["banned"] == false) ? $user : false;
			} else {
				return false;
			}
		}

		public function getUserByFbId($fb_id = null) {

			if (is_null($fb_id)) {
				return false;
			}

			$sql = "SELECT id, fb_id, banned FROM photosparis.users WHERE fb_id = :fb;";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				                      "fb" => $fb_id,
			                      ]);

			if ($state) {
				return $rq->fetch(PDO::FETCH_ASSOC);
			} else {
				return false;
			}
		}

		public function addPhotoLink($user = null, $photoID = null) {

			if (is_null($photoID) || is_null($user)) {
				return false;
			}

			$sql = "INSERT INTO photosparis.user_photos(user_id, photo_id) VALUES (:user, :photo);";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				                      "user"  => $user,
				                      "photo" => $photoID,
			                      ]);

			if ($state) {
				return true;
			} else {
				return false;
			}
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

		public function alreadyHaveFBPhoto($user = null, $fb_id = null) {

			if (is_null($fb_id) || is_null($user)) {
				return false;
			}

			$sql = "SELECT
					u.id as user,
					u.banned,
					p.id as photo,
					up.removed
				FROM
					photosparis.users AS u
					INNER JOIN photosparis.user_photos AS up
						ON u.id = up.user_id
					INNER JOIN photosparis.photos AS p
						ON up.photo_id = p.id
				WHERE
					u.id = :user
					AND p.fb_id = :photo
					AND up.removed != TRUE";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				                      "user"  => $user,
				                      "photo" => $fb_id,
			                      ]);

			if ($state) {
				return $rq->rowCount() > 0; // no photos
			} else {
				return false;
			}
		}

		public function add($user = null) {

			if (is_null($user)) {
				return false;
			}

			$sql = "INSERT INTO photosparis.users(fb_id) VALUES (:fb_id);";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				                      "fb_id" => $user->getFbId(),
			                      ]);

			if ($state) {
				return $this->db->lastInsertId('photosparis.users_id_seq1');
			} else {
				return false;
			}
		}

		public function patch($user = null) {

			if (is_null($user)) {
				return false;
			}

			$sql = "UPDATE photosparis.users SET banned = :banned WHERE id = :id;";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				                      "banned" => $user->getBanned(),
				                      "id"     => $user->getId(),
			                      ]);

			if ($state) {
				return $user;
			} else {
				return false;
			}
		}

		public function hasVoted($userID, $photoID) {

			if (is_null($userID) || is_null($photoID)) {
				return false;
			}

			$sql = "SELECT user_id, photo_id FROM photosparis.user_photos WHERE user_id = :user AND photo_id = :photo";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				                      'user'  => $userID,
				                      'photo' => $photoID,
			                      ]);

			if ($state) {
				$vote = $rq->fetch(PDO::FETCH_ASSOC);

				return empty($vote);
			} else {
				return false;
			}
		}

		public function removeVote($photoID, $userID) {

			if (is_null($photoID) || is_null($userID)) {
				return false;
			}

			$sql = "DELETE FROM photosparis.likes WHERE photo_id = :photo AND user_id= :user;";

			$rq = $this->db->prepare($sql);

			$state = $rq->execute([
				                      "photo" => $photoID,
				                      "user"  => $userID,
			                      ]);

			if ($state) {
				return true;
			} else {
				return false;
			}
		}

	}