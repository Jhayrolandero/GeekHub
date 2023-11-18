<?php
session_start();
include "../model/FriendModel.php";
include "../view/friend/suggestion.php";
include "../view/friend/pending.php";
include "../view/friend/list.php";
include "../view/sidebar/sideFriendCard.php";
class FriendController
{

    private $model;
    public function __construct()
    {
        $this->model = new Friend();
    }

    // Show friend suggestions
    public function show_Suggestion($username, $userID, $email)
    {
        return show_SuggestionList($username, $userID, $email);
    }

    // Show all friend list
    public function show_Accepted($username, $userID)
    {
        return show_AcceptedList($username, $userID);
    }

    // Show all pending list
    public function show_Pending($username, $userID, $friendship_id)
    {
        return show_PendingList($username, $userID, $friendship_id);
    }

    // Get all users' info
    public function get_Users($userID)
    {
        return $this->model->get_Users($userID);
    }

    // Add a friend request
    public function add_Friend($user_ID, $friend_ID)
    {
        try {
            $this->model->add_Friend($user_ID, $friend_ID);
        } catch (Exception $e) {
            return $e;
        }
    }

    // Get all pending user's id
    public function get_PendingID($userID)
    {
        try {
            return $this->model->get_PendingID($userID);
        } catch (Exception $e) {
            return $e;
        }
    }

    // Get all pending user
    public function show_PendingUser($userID)
    {
        try {
            return $this->model->show_Pending($userID);
        } catch (Exception $e) {
            return $e;
        }
    }

    // Accept friend request
    public function accept_Friend($friendshipID)
    {
        try {
            $this->model->accept_Friend($friendshipID);
        } catch (Exception $e) {
            return $e;
        }
    }

    // Get all pending user's id
    public function get_AcceptedID($userID)
    {
        try {
            return $this->model->get_AcceptedID($userID);
        } catch (Exception $e) {
            return $e;
        }
    }

    // Get all pending user
    public function show_AcceptedUser($userID)
    {
        try {
            return $this->model->show_Accepted($userID);
        } catch (Exception $e) {
            return $e;
        }
    }

    // Show friend nav
    public function friend_nav($username, $userID)
    {
        return template_friend_nav($username, $userID);
    }
}

$friend = new FriendController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "addFriend") {
        $userID = $_POST["userID"];
        $friendID = $_POST["friendID"];

        try {
            $friend->add_Friend($userID, $friendID);
            echo "Added Successfully";
        } catch (Exception $e) {
            echo $e;
        }
    }

    if (isset($_POST["action"]) && $_POST["action"] === "acceptFriend") {
        $friendshipID = $_POST["friendshipID"];

        try {
            $friend->accept_Friend($friendshipID);
            echo "Friend Accepted";
        } catch (Exception $e) {
            echo $e;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "suggestion":

                $results = $friend->get_Users($_SESSION["user"]);

                // var_dump($results);
                foreach ($results as $result) {
                    echo $friend->show_Suggestion($result["username"], $result["user_id"], $result["email"]);
                }
                break;

            case "list":
                $results = $friend->get_AcceptedID($_SESSION["user"]);
                $users = array();

                // Add all users' info to an array
                foreach ($results as $result) {
                    array_push($users, $friend->show_AcceptedUser($result["friend_id"]));
                }


                // Rendering of users' info
                foreach ($users as $user) {
                    echo $friend->show_Accepted($user["username"], $user["user_id"]);
                }
                break;

            case "pending":
                $results = $friend->get_PendingID($_SESSION["user"]);
                // print_r($results);
                $users = array();


                // Add all users' info to an array
                foreach ($results as $result) {
                    array_push($users, $friend->show_PendingUser($result["user_id"]));
                    // print_r($friend->show_PendingUser($result["user_id"]));
                }

                // print_r($users);

                // Rendering of users' info
                foreach ($users as $user) {
                    echo $friend->show_Pending($user["username"], $user["user_id"], $user["friendship_id"]);
                }
                break;

            case "homeList":
                $results = $friend->get_AcceptedID($_SESSION["user"]);
                $users = array();

                // Add all users' info to an array
                foreach ($results as $result) {
                    array_push($users, $friend->show_AcceptedUser($result["friend_id"]));
                }


                // Rendering of users' info
                foreach ($users as $user) {
                    echo $friend->friend_nav($user["username"], $user["user_id"]);
                }
                break;
        }
    }
}
