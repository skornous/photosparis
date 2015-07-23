<?php
/**
 * Created by PhpStorm.
 * User: Leelo
 * Date: 23/07/2015
 * Time: 03:10
 */

namespace App\Controllers;


use App\Models\User\User;

class UserController extends Controller {

    public function __construct($id = null) {
        parent::__construct();
        $this->loadModel("User");
    }


    public function add() {
        $user = (isset($_POST['user'])) ? $_POST['user'] : null;
        $banned = (isset($_POST['banned'])) ? $_POST['banned'] : false;

        if (is_null($user) || is_null($banned)) {echo "Param null"; return false; }

        // check if user fb exists
        $dbUser = $this->Models["User"]->getUserByFbId($user);

        if ($dbUser !== false) {
            echo "User already exist";
            return false;
        }else{
            $addedUser = $this->Models["User"]->add(User::createFromArray([
                "id" => 0,
                "fb_id" => $user,
                "banned" => $banned
            ]));

            var_dump($addedUser);
        }
    }
}