<?php

namespace App\Controllers;


class Controller {

	function __construct() {
	}

	protected function loadModel($modelName = null) {
		if (is_null($modelName)) { return false; }

		if(!isset($this->Models) || empty($this->Models)) {
			$this->Models = [];
		}

		$model = "App\\Models\\" . $modelName . "\\" . $modelName . "Table";
		$this->Models[$modelName] = new $model;
	}
}