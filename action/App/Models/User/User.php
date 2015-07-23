<?php

namespace App\Models\User;


class User {

	private $id;
	private $fb_id;
	private $banned;

	public function exchangeArray($data) {
		$this->id = (isset($data["id"])) ? $data["id"] : null;
		$this->fb_id = (isset($data["fb_id"])) ? $data["fb_id"] : null;
		$this->banned = (isset($data["banned"])) ? $data["banned"] : null;
	}

	public function getArrayCopy() {
		return [
			'id' => (int) $this->id,
			'fb_id' => $this->fb_id,
			'banned' => $this->banned,
		];
	}

	public static function createFromArray($data = null) {
		if (is_null($data)) { return false; }

		$user = new User;
		$user->exchangeArray($data);

		return $user;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getFbId() {
		return $this->fb_id;
	}

	public function setFbId($fb_id) {
		$this->fb_id = $fb_id;
	}

	public function getBanned() {
		return $this->banned;
	}

	public function setBanned($banned) {
		$this->banned = $banned;
	}

}