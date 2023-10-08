<?php
session_start();
class UserController{
    public function get_ID(){
        if(empty($_SESSION["user"])){
            echo "User isn't log on!";
        }else{
            echo $_SESSION["user"];
        }
    }
}

$user = new UserController();

if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] === "getID"){
    $user->get_ID();
}