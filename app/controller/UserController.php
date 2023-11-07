<?php
session_start();
include "../model/UserModel.php";
include "../view/profile.php";
class UserController{

    private $model;

    public function __construct(){
        $this->model = new User();
    }
    public function get_ID(){
        if(empty($_SESSION["user"])){
            echo "User isn't log on!";
        }else{
            echo $_SESSION["user"];
        }
    }

    public function get_user($id){
        try{
            return $this->model->get_user($id);
        } catch(Exception $e){
            return $e->getMessage();
        }
    }


}

$user = new UserController();

if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] === "getID"){
    $user->get_ID();
}

if($_SERVER["REQUEST_METHOD"] === "GET"){

    // For viewing other profile
    if(isset($_GET["action"]) && $_GET["action"] === "getProfile" && isset($_GET["buddyID"])){
        $id = $_GET["buddyID"];
        $result = $user->get_user($id);
        echo profile_Template($result[0]["username"]);
    }

    if(isset($_GET["action"]) && $_GET["action"] === "getProfile" && $_GET["userProfile"]){
        $id = $_SESSION["user"];
        $result = $user->get_user($id);
        echo profile_Template($result[0]["username"]);

        // echo $id;
        // var_dump($result);
        // echo "hello";
    }

}