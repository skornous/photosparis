<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 25/04/2015
 * Time: 14:58
 */

class FirstTest extends PHPUnit_Framework_TestCase {

	public function testPassing() {
		// Assert
		$this->assertTrue(true);
	}
	public function testFailing() {
		// Assert
		$this->assertTrue(false);
	}

}