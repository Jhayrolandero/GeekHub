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

    // Gettin User info
    public function get_user($id)
    {
        try {
            return $this->model->get_user($id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Template to render profile
    public function show_profile($username, $userBio, $createdAt,  $userID, $profileImg, $profileBG)
    {
        return profile_Template($username, $userBio, $createdAt, $userID, $profileImg, $profileBG);
    }

    // For bio
    public function add_bio($userID, $userBio)
    {
        return $this->model->add_bio($userID, $userBio);
    }

    // Update Profile
    public function edit_profile($userID, $username, $profileImg, $profileBG)
    {
        return $this->model->edit_profile($userID, $username, $profileImg, $profileBG);
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

    // File validation
    public static function file_validation($file)
    {
        // Check if the file input is set and not empty
        if (isset($file["name"]) && !empty($file["name"])) {

            // Get file information
            $fileName = basename($file["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Check if the file is an image
            $isImage = getimagesize($file["tmp_name"]);

            if ($isImage === false) {
                return -1;
            }

            if ($file["size"] > 5000000) {
                return 0;
            }

            return 1;
        }
    }
}

$user = new UserController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // For Bio
    if (isset($_POST["action"]) && $_POST["action"] === "addBio") {
        try {

            $userID = $_POST["userID"];
            $userBio = $_POST["bio"];

            echo $user->add_bio($userID, $userBio);
        } catch (Exception $e) {
            echo "Error";
        }
    }

    // For Update Profile
    if (isset($_POST["action"]) && $_POST["action"] === "updateProfile") {
        try {

            $userID = $_POST["userID"];
            $username = $_POST["username"];
            // $image = (isset($_FILES["profilePic"]) && $_FILES["profilePic"]["error"] === 0) ? file_get_contents($_FILES['profilePic']['tmp_name']) : null;

            // Validate the image first
            $image = (isset($_FILES["profilePic"]) && $_FILES["profilePic"]["error"] === 0) ? $_FILES["profilePic"] : null;

            if ($image) {
                $result = $user::file_validation($image);

                if ($result == -1) {

                    die("Image is only allowed");
                } else if ($result == 0) {

                    die("Size is too large!");
                } else if ($result == 1) {

                    $image = file_get_contents($_FILES['profilePic']['tmp_name']);
                }
            }
            // $imageBG = (isset($_FILES["profileBG"]) && $_FILES["profileBG"]["error"] === 0) ? file_get_contents($_FILES['profileBG']['tmp_name']) : null;
            // Same with BG
            $imageBG = (isset($_FILES["profileBG"]) && $_FILES["profileBG"]["error"] === 0) ? $_FILES["profileBG"] : null;

            if ($imageBG) {
                $result = $user::file_validation($imageBG);

                if ($result == -1) {

                    die("Image is only allowed");
                } else if ($result == 0) {

                    die("Size is too large!");
                } else if ($result == 1) {

                    $imageBG = file_get_contents($_FILES['profileBG']['tmp_name']);
                }
            }

            echo $user->edit_profile($userID, $username, $image, $imageBG);
        } catch (Exception $e) {
            echo $e;
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
        $profileImg = $result[0]["user_profile"];
        $profileBG = $result[0]["profile_background"];

        echo $user->show_profile($username, $userBio, $createdAt,  $userID, $profileImg, $profileBG);
    }

    // // Search User
    // if (isset($_GET["action"]) && $_GET["action"] === "searchUser") {
    //     $username = $_GET["username"];

    //     $results = $user->search_user($username);

    //     foreach ($results as $result) {
    //         echo $user->show_search_user($result["username"], $result["user_id"]);
    //     }
    // }

    // Get profile Stat
    if (isset($_GET["action"]) && $_GET["action"] === "getStat") {

        $userID = $_GET["userID"];
        $result = $user->get_user($userID);

        $buddyCount = $result[0]["buddy_count"];
        $postCount = $result[0]["post_count"];
        $likeCount = $result[0]["like_count"];

        $stat = array(
            "buddy_count" => $buddyCount,
            "post_count" => $postCount,
            "like_count" => $likeCount
        );

        $statJSON = json_encode($stat);

        // Set the Content-Type header to application/json
        header('Content-Type: application/json');

        // Send the JSON response
        echo $statJSON;
    }
}
