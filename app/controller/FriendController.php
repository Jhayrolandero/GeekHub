<?php
session_start();
include "../model/FriendModel.php";
include "../view/friend/suggestion.php";
include "../view/friend/pending.php";
include "../view/friend/recommended.php";
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
    public function show_Suggestion($username, $userID, $email, $profile, $bio)
    {
        return show_SuggestionList($username, $userID, $email, $profile, $bio);
    }

    // Show all friend list
    public function show_Accepted($username, $userID, $profile, $bio)
    {
        return show_AcceptedList($username, $userID, $profile, $bio);
    }

    // Show all pending list
    public function show_Pending($username, $userID, $friendship_id, $profile, $bio)
    {
        return show_PendingList($username, $userID, $friendship_id, $profile, $bio);
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
    public function get_AcceptedID($userID, $limit = null, $random = false)
    {
        try {
            return $this->model->get_AcceptedID($userID, $limit, $random);
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
    public function friend_nav($username, $userID, $profileImg)
    {
        return template_friend_nav($username, $userID, $profileImg);
    }

    // unfriend
    public function unfriend_friend($userID, $friendID)
    {
        return $this->model->unfriend_friend($userID, $friendID);
    }

    // Show Recommend
    public function show_recommend($results)
    {
        return show_template_recommend($results);
    }
}

$friend = new FriendController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Adding Friend
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

    // Accepting Friend
    if (isset($_POST["action"]) && $_POST["action"] === "acceptFriend") {
        $friendshipID = $_POST["friendshipID"];

        try {
            $friend->accept_Friend($friendshipID);
            echo "Friend Accepted";
        } catch (Exception $e) {
            echo $e;
        }
    }

    // Unfriend

    if (isset($_POST["action"]) && $_POST["action"] === "unfriendFriend") {

        $userID = $_POST["userID"];
        $friendshipID = $_POST["friendshipID"];

        try {
            echo $friend->unfriend_friend($userID, $friendshipID);
        } catch (Exception $e) {
            echo $e;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {

                // Show Suggestion
            case "suggestion":

                $results = $friend->get_Users($_SESSION["user"]);

                // var_dump($results);
                foreach ($results as $result) {

                    $username = $result["username"];
                    $userID = $result["user_id"];
                    $email = $result["email"];
                    $profile = $result["user_profile"];
                    $bio = isset($result["user_bio"]) ? $result["user_bio"] : "Nothing to see here";

                    echo $friend->show_Suggestion($username, $userID, $email, $profile, $bio);
                }
                break;

                // Show Buddies
            case "list":
                $results = $friend->get_AcceptedID($_SESSION["user"]);
                $users = array();

                // Add all users' info to an array
                foreach ($results as $result) {
                    array_push($users, $friend->show_AcceptedUser($result["friend_id"]));
                }


                // Rendering of users' info
                foreach ($users as $user) {

                    $username = $user["username"];
                    $userID = $user["user_id"];
                    $profile = $user["user_profile"];
                    $bio = isset($user["user_bio"]) ? $user["user_bio"] : "Nothing to see here";

                    echo $friend->show_Accepted($username, $userID, $profile, $bio);
                }
                break;

                // Show pending
            case "pending":
                $results = $friend->get_PendingID($_SESSION["user"]);
                // print_r($results);
                $users = array();


                // Add all users' info to an array
                foreach ($results as $result) {
                    array_push($users, $friend->show_PendingUser($result["user_id"]));
                }

                // Rendering of users' info
                foreach ($users as $user) {

                    $username = $user["username"];
                    $userID = $user["user_id"];
                    $friendshipID = $user["friendship_id"];
                    $email = $user["email"];
                    $profile = $user["user_profile"];
                    $bio = isset($result["user_bio"]) ? $result["user_bio"] : "Nothing to see here";


                    echo $friend->show_Pending($username, $userID, $friendshipID, $profile, $bio);
                }
                break;

                // Show friend Nav
            case "homeList":
                $results = $friend->get_AcceptedID($_SESSION["user"], 15, true);
                $users = array();

                // Add all users' info to an array
                foreach ($results as $result) {
                    array_push($users, $friend->show_AcceptedUser($result["friend_id"]));
                }

                // Rendering of users' info
                foreach ($users as $user) {
                    echo $friend->friend_nav($user["username"], $user["user_id"], $user["user_profile"]);
                }
                break;

            case "getRecommend":

                $results = $friend->get_Users($_SESSION["user"]);

                echo $friend->show_recommend($results);
                break;
        }
    }
}
