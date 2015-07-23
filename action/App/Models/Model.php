<?php

namespace App\Models;

use App\Core\DB;

class Model {

	protected $db;

	function __construct() {
		$db = new DB;
		$this->db = $db->getPdo();
	}
}