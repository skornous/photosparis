<?php

namespace App\Models\Photo;


class Photo {

	private $id;
	private $fb_id;
	private $removed;

	public function exchangeArray($data) {
		$this->id = (isset($data["id"])) ? $data["id"] : null;
		$this->fb_id = (isset($data["fb_id"])) ? $data["fb_id"] : null;
		$this->removed = (isset($data["removed"])) ? $data["removed"] : null;
	}

	public function getArrayCopy() {
		return [
			'id' => (int) $this->id,
			'fb_id' => $this->fb_id,
			'removed' => $this->removed,
		];
	}

	public static function createFromArray($data = null) {
		if (is_null($data)) { return false; }

		$photo = new Photo;
		$photo->exchangeArray($data);

		return $photo;
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

	public function getRemoved() {
		return $this->removed;
	}

	public function setRemoved($removed) {
		$this->removed = $removed;
	}

}