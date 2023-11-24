<?php
session_start();
include "../model/UserModel.php";
include "../view/profile/profileCard.php";
include "../view/searchbar/searchbar.php";
class UserController
{

    private $model;

    public function __construct()
    {
        $this->model = new User();
    }
    public function get_ID()
    {
        if (empty($_SESSION["user"])) {
            echo "User isn't log on!";
        } else {
            echo $_SESSION["user"];
        }
    }

    public function get_user($id)
    {
        try {
            return $this->model->get_user($id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show_profile($username, $userBio, $createdAt, $buddyCount, $postCount, $likeCount, $userID)
    {
        return profile_Template($username, $userBio, $createdAt, $buddyCount, $postCount, $likeCount, $userID);
    }

    public function add_bio($userID, $userBio)
    {
        return $this->model->add_bio($userID, $userBio);
    }

    public function search_user($username)
    {
        return $this->model->search_user($username);
    }

    // Show results
    public function show_search_user($username, $userID)
    {
        return template_search($username, $userID);
    }

    public static function month_day($date)
    {
        // Create a DateTime object from the string
        $dateTime = new DateTime($date);

        // Format the DateTime object as "F j" (Month Day)
        $formattedDate = $dateTime->format("F j");

        // Output the result
        return $formattedDate;
    }
}

$user = new UserController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "addBio") {
        try {

            $userID = $_POST["userID"];
            $userBio = $_POST["bio"];

            echo $user->add_bio($userID, $userBio);
        } catch (Exception $e) {
            echo "Error";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] === "getID") {
    $user->get_ID();
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // Get profile
    if (isset($_GET["action"]) && $_GET["action"] === "getProfile" && $_GET["userProfile"]) {
        $id = $_GET["userProfile"];
        $result = $user->get_user($id);

        // var_dump($result);
        $username = $result[0]["username"];
        $userBio = isset($result[0]["user_bio"]) ? $result[0]["user_bio"] : "Nothing to see here";
        $date = $result[0]["create_date"];
        $createdAt = $user::month_day($date);
        $buddyCount = $result[0]["buddy_count"];
        $postCount = $result[0]["post_count"];
        $likeCount = $result[0]["like_count"];
        $userID = $result[0]["user_id"];

        echo $user->show_profile($username, $userBio, $createdAt, $buddyCount, $postCount, $likeCount, $userID);
    }

    // Search User
    if (isset($_GET["action"]) && $_GET["action"] === "searchUser") {
        $username = $_GET["username"];

        $results = $user->search_user($username);

        foreach ($results as $result) {
            echo $user->show_search_user($result["username"], $result["user_id"]);
        }
    }
}
