<?php

session_start();
include "../model/NotificationModel.php";
include "../view/home/notifCard.php";
class NotificationController
{

    private $model;

    public function __construct()
    {
        $this->model = new Notification();
    }

    public function add_notification($user_id, $target_id, $message, $type, $post_id)
    {
        $this->model->add_notification($user_id, $target_id, $message, $type, $post_id);
    }


    // Template for notif card
    public function template_notification($username, $date, $message, $profileImg, $userID)
    {
        return template_notif($username, $date, $message, $profileImg, $userID);
    }

    public function template_empty_notification()
    {
        return template_empty();
    }

    // Ensure the like notif only happen once so user doesn't spam a notif
    public function has_liked_notif($post_id, $user_id)
    {
        try {
            $hasLiked = false;

            if ($this->model->has_liked_notif($post_id, $user_id)) {
                $hasLiked = true;
            }

            return $hasLiked;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_notification($userID)
    {
        return $this->model->get_notification($userID);
    }
}


$notif = new NotificationController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Like Notif
    if (isset($_POST["action"]) && $_POST["action"] === "likeNotif") {
        try {

            $target_id = $_POST["targetID"];
            $post_id = $_POST["postID"];
            $user_id = $_SESSION["user"];

            // Ensure the you dont send notif to yourself
            if ($target_id == $_SESSION["user"]) {
                die("what?");
            }

            if ($notif->has_liked_notif($post_id, $user_id)) {
                die("Already Liked");
            }

            echo $notif->add_notification($_SESSION["user"], $target_id, "has liked your post!", "like", $post_id);
        } catch (Exception $e) {
            echo ("Error in notification");
        }
    }

    // Comment Notif
    if (isset($_POST["action"]) && $_POST["action"] === "commentNotif") {
        try {
            $target_id = $_POST["targetID"];
            $post_id = $_POST["postID"];
            $user_id = $_SESSION["user"];

            if ($target_id == $_SESSION["user"]) {
                die();
            }

            echo $notif->add_notification($_SESSION["user"], $target_id, "has commented on your post!", "comment", $post_id);
        } catch (Exception $e) {
            echo ($e);
        }
    }

    // Friend Request Notif
    if (isset($_POST["action"]) && $_POST["action"] === "requestNotif") {
        try {
            $target_id = $_POST["targetID"];
            $user_id = $_SESSION["user"];

            if ($target_id == $_SESSION["user"]) {
                die("what?");
            }

            echo $notif->add_notification($_SESSION["user"], $target_id, "has added you!", "add", $post_id = null);
        } catch (Exception $e) {
            echo ($e);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["action"]) && $_GET["action"] === "getNotif") {
        try {
            $results = $notif->get_notification($_SESSION["user"]);

            // Render when there's no Notification
            if (empty($results[0])) {
                echo $notif->template_empty_notification();
            }

            // Render Notification
            foreach ($results as $result) {
                $username = $result["username"];
                $date = $result["created_at"];
                $message = $result["message"];
                $profileImg = $result["user_profile"];
                $userID = $result["user_id"];

                echo $notif->template_notification($username, $date, $message, $profileImg, $userID);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
