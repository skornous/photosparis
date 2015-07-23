<?php
/**
 * Created by PhpStorm.
 * User: Leelo
 * Date: 23/07/2015
 * Time: 04:25
 */

namespace App\Controllers;


class EventController extends Controller{

    public function __construct($id = null) {
        parent::__construct();
        $this->loadModel("Event");
    }

    public function add() {
        $addedEvent = $this->Models["Event"]->add();
        var_dump($addedEvent);
    }
}