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
	}