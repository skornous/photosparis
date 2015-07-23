<?php

namespace App\Core;
use \PDO;
use \Exception;

class DB {

	private $pdo;
	private $default = [ //todo change for heroku's values
		"dbname" => "dbsivsg0ehbnft",
		"dbhost" => "localhost",
		"dbuser" => "stxuwzojsvbypr",
		"dbpassword" => "esgi",
	];

	function __construct($dbname = null, $dbhost = null, $dbuser = null, $dbpassword = null) {

		if(is_null($dbname) || is_null($dbhost) || is_null($dbuser) ||is_null($dbpassword)) { // use default values
			$dbname = $this->default["dbname"];
			$dbhost = $this->default["dbhost"];
			$dbuser = $this->default["dbuser"];
			$dbpassword = $this->default["dbpassword"];
		}

		$this->pdo = $this->getPdoInstance($dbname, $dbhost, $dbuser, $dbpassword);
	}

	// get an instance of PDO
	public function getPdoInstance($dbname = null, $dbhost = null, $dbuser = null, $dbpassword = null) {
		$pdo = null;

		try {
			// normal connection
			$pdo = new PDO("pgsql:dbname=" . $dbname . ";host=".$dbhost, $dbuser, $dbpassword );
			// ssl connection
//			$pdo = new PDO("pgsql:dbname=" . $dbname . ";host=".$dbhost . ";user=" . $dbuser . ";password=" . $dbpassword . ";sslmode=require" );
		} catch (Exception $e) {
			echo "Unable to connect to database<br>" . $e->getMessage();
		}

		return $pdo;
	}

	public function getPdo() {
		return $this->pdo;
	}



}