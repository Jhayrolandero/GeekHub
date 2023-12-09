<?php

session_start();
include "../model/LikeModel.php";

class LikeController
{

    private $model;
    public function __construct()
    {
        $this->model = new Like();
    }

    // Add like to comment
    public function add_like($post_id, $user_id)
    {
        return $this->model->add_like($post_id, $user_id);
    }

    public function delete_like($post_id, $user_id)
    {
        return $this->model->delete_like($post_id, $user_id);
    }

    public function get_likes($postID)
    {
        return $this->model->get_likes($postID);
    }
}

$like = new LikeController();

// Like Comment
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "like") {
        try {
            $post_id = $_POST["post_id"];
            $user_id = $_POST["user_id"];

            echo $like->add_like($post_id, $user_id);
        } catch (Exception $e) {
            echo "" . $e->getMessage() . "";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Dislike comment
    if (isset($_GET["action"]) && $_GET["action"] === "unlike") {
        try {
            $post_id = $_GET["post_id"];
            $user_id = $_GET["user_id"];

            echo $like->delete_like($post_id, $user_id);
        } catch (Exception $e) {
            echo "" . $e->getMessage() . "";
        }
    }

    // Get likes
    if (isset($_GET["action"]) && $_GET["action"] === "getLikes") {
        try {
            $post_id = $_GET["post_id"];

            $likes = $like->get_likes($post_id);
            echo json_encode($likes);

            header("Content-Type: application/json");
            exit();
        } catch (Exception $e) {
            echo "" . $e->getMessage() . "";
        }
    }
}
