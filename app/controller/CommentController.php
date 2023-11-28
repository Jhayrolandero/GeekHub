<?php
include "../model/CommentModel.php";
include "../view/home/commentBox.php";
class CommentController
{
    private $model;
    public function __construct()
    {
        $this->model = new Comment();
    }

    // Adding Comment
    public function add_comment($user_id, $post_id, $comment)
    {
        return $this->model->add_comment($user_id, $post_id, $comment);
    }

    // Showing Comment
    public function show_comment($post_id)
    {
        try {
            return $this->model->show_comment($post_id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Template for comment box component
    public function template_commentBox($username, $time, $content, $userID, $comment_id, $post_id, $profileImg)
    {
        return template_commentBox($username, $time, $content, $userID, $comment_id, $post_id, $profileImg);
    }
    public function delete_comment($commendID)
    {
        try {
            $this->model->delete_comment($commendID);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Just to convert time into more readable format
    public static function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime("", new DateTimeZone('Asia/Manila'));
        $dateTime = new DateTime($datetime, new DateTimeZone('Asia/Manila'));
        $diff = $now->diff($dateTime);

        $diff_str = '';

        if ($diff->y > 0) {
            $diff_str .= $diff->y . ' year';
            if ($diff->y > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } elseif ($diff->m > 0) {
            $diff_str .= $diff->m . ' month';
            if ($diff->m > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } elseif ($diff->d > 0) {
            $diff_str .= $diff->d . ' day';
            if ($diff->d > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } elseif ($diff->h > 0) {
            $diff_str .= $diff->h . ' hour';
            if ($diff->h > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } elseif ($diff->i > 0) {
            $diff_str .= $diff->i . ' minute';
            if ($diff->i > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } elseif ($diff->s > 0) {
            $diff_str .= $diff->s . ' second';
            if ($diff->s > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } else {
            $diff_str = 'Just now';
        }

        return $diff_str;
    }
}

$comment = new CommentController();

// Add comment
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "addComment") {

        if (empty($_POST["comment"])) {
            die("Say Something");
        }

        try {
            $commentContent = $_POST["comment"];
            $userID = $_POST["userID"];
            $postID = $_POST["postID"];

            echo $comment->add_comment($userID, $postID, $commentContent);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Delete a Comment
    if (isset($_POST["action"]) && $_POST["action"] === "deleteComment") {
        try {
            $commentID = $_POST["commentID"];
            $comment->delete_comment($commentID);
            echo "Comment Deleted";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // Get comment info
    if (isset($_GET["action"]) && $_GET["action"] === "showComment") {
        try {

            $postID = $_GET["postID"];
            // $limit = $_GET["limit"];

            $results = $comment->show_comment($postID);

            // var_dump($results);
            foreach ($results as $result) {
                $username = $result["username"];
                $timestamp = $result["created_at"];
                $date = CommentController::time_elapsed_string($timestamp);
                $commentContent = $result["comment"];
                $userID = $result["user_id"];
                $commentID = $result["comment_id"];
                $postID = $result["post_id"];
                $profileImg = $result["user_profile"];

                echo $comment->template_commentBox($username, $date, $commentContent, $userID, $commentID, $postID, $profileImg);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
