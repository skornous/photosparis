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

            if ($addedUser !== false) {
                echo "User added as $addedUser<br>";
            }else{
                echo "Photo not added";
            }
        }
    }

    public function patch() {
        $patch_datas = get_object_vars(json_decode(file_get_contents('php://input')));

        $banned = (isset($patch_datas['banned'])) ? $patch_datas['banned'] : null;
        $user = (isset($patch_datas['user'])) ? $patch_datas['user'] : null;

        if (is_null($user)||is_null($banned)) { echo "Param missing"; return false; }

        // transform user fb id into a user
        $dbUser = $this->Models["User"]->getUserByFbId($user);

        if ($dbUser !== false) {
            $dbUser = User::createFromArray($dbUser);
            $dbUser->setBanned($banned);

            $dbUser = $this->Models["User"]->patch($dbUser);

            if ($dbUser !== false) {
                echo "Update success for user $user";
            }else{
                echo "Update failed";
            }
        }else{
            echo "User does not exist";
        }
    }
}