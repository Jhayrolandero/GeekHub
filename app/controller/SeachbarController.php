<?php

include "../model/SearchbarModel.php";
include "../view/searchbar/searchbar.php";

class SeachbarController
{

    private $model;

    public function __construct()
    {
        $this->model = new Search();
    }


    // Search User
    public function search_user($username)
    {
        return $this->model->search_user($username);
    }

    // Search Community
    public function search_community($communityName)
    {
        return $this->model->search_community($communityName);
    }

    // Show results
    public function show_search_user($username, $userID, $profileImg)
    {
        return template_search($username, $userID, $profileImg);
    }
}


$search = new SeachbarController();


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Search User
    if (isset($_GET["action"]) && $_GET["action"] === "searchUser") {

        $username = $_GET["username"];

        $users = $search->search_user($username);
        $communities = $search->search_community($username);


        // Iterate through $users
        foreach ($users as $user) {
            echo $search->show_search_user($user["name"], "#profile#" . $user["ID"], $user["profile"]);
        }

        // Iterate through $communities
        foreach ($communities as $community) {
            echo $search->show_search_user($community["name"], "#group#" . $community["ID"], $community["profile"]);
        }
        // $results = array_merge($users, $communities);

        // var_dump($results);

        // foreach ($results as $result) {
        //     echo $search->show_search_user($result["name"], $result["ID"], $result["profile"]);
        // }
    }
}
